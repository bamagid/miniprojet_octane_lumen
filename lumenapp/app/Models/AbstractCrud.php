<?php
namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\DB;

abstract class AbstractCrud extends Model
{
    // use HasFactory;

    // abstract protected function getModelClass(): string;

    // protected function getModelInstance()
    // {
    //     $modelClass = $this->getModelClass();
    //     return new $modelClass;
    // }

    // public function handle(Request $request, string $operation, string $message, int $id = null ,?array $rules=null , $returnJson = true  )
    // {
    //     try {
    //         DB::beginTransaction();

    //         switch ($operation) {
    //             case 'create':
    //                 $result = $this->createRecord($request,$rules);
    //                 break;
    //             case 'read':
    //                 $result = $this->readRecord($id);
    //                 break;
    //             case 'update':
    //                 $result = $this->updateRecord($request, $id,$rules);
    //                 break;
    //             case 'delete':
    //                 $result = $this->deleteRecord($id);
    //                 break;
    //             default:
    //                 throw new \Exception("Operation not supported");
    //         }

    //         DB::commit();
    //         return $this->response($result, $message);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return $this->response(null, $e->getMessage(), false);
    //     }
    // }

    // protected function createRecord(Request $request,$rules)
    // {
    //     $rules ? $this->validate($request, $rules) : '';
    //     $data = $request->all();
    //     $this->beforeCreate($data);
    //     return $this->getModelInstance()->create($data);
    // }

    // protected function readRecord(int $id = null)
    // {
    //     if ($id) {
    //         $this->beforeRead($id);
    //         return $this->getModelInstance()->findOrFail($id);  
    //     }
    //     $this->beforeRead();
    //     return $this->getModelInstance()->all();
    // }

    // protected function updateRecord(Request $request, int $id, $rules)
    // {
    //     $rules ? $this->validate($request, $rules) : '';
    //     $data = $request->all();
    //     $this->beforeUpdate($data, $id);
    //     $model = $this->getModelInstance()->findOrFail($id);
    //     $model->update($data);
    //     return $model;
    // }

    // protected function deleteRecord(int $id)
    // {
    //     $model = $this->getModelInstance()->findOrFail($id);
    //     $this->beforeDelete($model);
    //     $model->delete();
    //     return $model;
    // }

    // protected function validate(Request $request, array $rules)
    // {
    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         throw new \Illuminate\Validation\ValidationException($validator);
    //     }
    // }

    // protected function response($data, string $message, bool $success = true)
    // {
    //     return [
    //         'success' => $success,
    //         'message' => $message,
    //         $this->getModelClass()."s" => $data
    //     ];
    // }

    // // Methods to be overridden by child classes if needed
    // protected function beforeRead(int $id = null) {}
    // protected function beforeCreate(array &$data) {}
    // protected function beforeUpdate(array &$data, int $id) {}
    // protected function beforeDelete(Model $model) {}
}