<?php

namespace app\controllers\admin;

use Yii;
use app\models\entities\BookAuthorEntity;
use Throwable;
use app\models\entities\BookEntity;
use app\models\search\BookSearch;
use app\components\web\SecuredController;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * BookController implements the CRUD actions for BookEntity model.
 */
class BookController extends SecuredController
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex(): string
    {
        $searchModel = new BookSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BookEntity model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id): string
    {
        $authorBook = BookEntity::getBookFullNameAuthor($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'authorBook' => $authorBook,
        ]);
    }

    /**
     * Creates a new BookEntity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws ErrorException
     */
    public function actionCreate()
    {
        $model = new BookEntity();
        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($transaction === null) {
                return $this->redirect('index');
            }
            try {
                if(!$model->save()){
                    throw new Exception('First level');
                }

                foreach ($model->selectedAuthors as $author) {
                    $bookAuthor = new BookAuthorEntity();
                    $bookAuthor->book_id = $model->id;
                    $bookAuthor->author_id = $author;
                    if (!$bookAuthor->save()) {
                        throw new Exception('Second level');
                    }
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', Yii::t('app', 'Book "' . $model->title . '" saved successfully'));
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (Exception $e) {
                $transaction->rollBack();

                BookEntity::deleteDirectoryImage($model->picture);
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error "' . $e->getMessage() . '". Book not saved.'));
            }

            return $this->redirect('index');
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_form', [
                'model' => $model
            ]);
        }
    }

    /**
     * Updates an existing BookEntity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $allAuthors = BookAuthorEntity::find()
            ->where(['book_id' => $id])
            ->asArray()
            ->all();

        $idAuthors = ArrayHelper::getColumn($allAuthors, 'author_id');
        $idBook = ArrayHelper::getColumn($allAuthors, 'id');

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            if ($transaction === null) {
                return $this->redirect('index');
            }
            try {
                if(!$model->save()){
                    throw new Exception('First level');
                }

                if ($model->selectedAuthors !== $idAuthors) {
                    foreach ($model->selectedAuthors as $author) {
                        $bookAuthor = new BookAuthorEntity();
                        $bookAuthor->book_id = $model->id;
                        $bookAuthor->author_id = $author;
                        if (!$bookAuthor->save()) {
                            throw new Exception('Second level');
                        }
                    }

                    $oldBookId = implode(",", $idBook);
                    Yii::$app->db->createCommand()
                        ->delete('book_author', 'book_id="' . $model->id . '" AND id IN (' . $oldBookId . ')')
                        ->bindValue(':book_id', $model->id)
                        ->bindValue(':id', $oldBookId)
                        ->execute();
                }

                $transaction->commit();
                Yii::$app->session->setFlash('success', Yii::t('app', 'The book has been successfully saved to the database'));
                return $this->redirect(['view', 'id' => $model->id]);

            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', Yii::t('app', 'Error "' . $e->getMessage() . '". Book not saved.'));
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        if (Yii::$app->request->isAjax) {

            Yii::$app->params['selected'] = $model->getSelectAuthors($idAuthors);
            return $this->renderAjax('_form', [
                'model' => $model
            ]);
        }
    }

    /**
     * Deletes an existing BookEntity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): Response
    {
        $model = $this->findModel($id);
        if ($model->delete()) {
            BookEntity::deleteDirectoryImage($model->picture);
            Yii::$app->session->setFlash('success', Yii::t('app', "Book $model->title successfully deleted."));
        } else {
            Yii::$app->session->setFlash('error', Yii::t('app', "Book $model->title not deleted."));
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the BookEntity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return BookEntity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel(int $id): BookEntity
    {
        if (($model = BookEntity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
