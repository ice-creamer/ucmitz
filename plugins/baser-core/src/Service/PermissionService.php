<?php
/**
 * baserCMS :  Based Website Development Project <https://basercms.net>
 * Copyright (c) baserCMS Permission Community <https://basercms.net/community/>
 *
 * @copyright     Copyright (c) baserCMS Permission Community
 * @link          https://basercms.net baserCMS Project
 * @since         5.0.0
 * @license       http://basercms.net/license/index.html MIT License
 */

namespace BaserCore\Service;

use BaserCore\Model\Entity\Permission;
use BaserCore\Model\Table\PermissionsTable;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Http\ServerRequest;
use Cake\ORM\Query;
use Cake\ORM\TableRegistry;
use Cake\Datasource\EntityInterface;
use BaserCore\Utility\BcUtil;
use BaserCore\Annotation\UnitTest;
use BaserCore\Annotation\NoTodo;
use BaserCore\Annotation\Checked;

/**
 * Class PermissionService
 * @package BaserCore\Service
 * @property PermissionsTable $Permissions
 */
class PermissionService implements PermissionServiceInterface
{

    /**
     * Permissions Table
     * @var \Cake\ORM\Table
     */
    public $Permissions;

    /**
     * PermissionService constructor.
     */
    public function __construct()
    {
        $this->Permissions = TableRegistry::getTableLocator()->get('BaserCore.Permissions');
    }

    /**
     * パーミッションの新規データ用の初期値を含んだエンティティを取得する
     * @param int $userGroupId
     * @return Permission
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function getNew($userGroupId): EntityInterface
    {
        return $this->Permissions->newEntity(
            $this->autoFillRecord(['user_group_id' => $userGroupId]),
            ['validate' => 'plain']
        );
    }

    /**
     * パーミッションを取得する
     * @param int $id
     * @return EntityInterface
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function get($id): EntityInterface
    {
        return $this->Permissions->get($id, [
            'contain' => ['UserGroups'],
        ]);
    }

    /**
     * パーミッション管理の一覧用のデータを取得
     * @param array $queryParams
     * @return Query
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function getIndex(array $queryParams): Query
    {
        $options = [];
        if (!empty($queryParams['user_group_id'])) {
            $options = ['conditions' => ['Permissions.user_group_id' => $queryParams['user_group_id']]];
        }
        $query = $this->Permissions->find('all', $options)->order('sort', 'ASC');
        return $query;
    }

    /**
     * パーミッション登録
     * @param ServerRequest $request
     * @return EntityInterface
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function create(array $postData): EntityInterface
    {
        $postData = $this->autoFillRecord($postData);
        $permission = $this->Permissions->newEmptyEntity();
        $permission = $this->Permissions->patchEntity($permission, $postData, ['validate' => 'default']);
        $this->Permissions->save($permission);
        return $permission;
    }

    /**
     * パーミッション情報を更新する
     * @param EntityInterface $target
     * @param array $data
     * @return EntityInterface
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function update(EntityInterface $target, array $data): EntityInterface
    {
        $data = $this->autoFillRecord($data);
        $permission = $this->Permissions->patchEntity($target, $data);
        $this->Permissions->save($permission);
        return $permission;
    }

    /**
     * 有効状態にする
     *
     * @param int $id
     * @return EntityInterface
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function publish($id): EntityInterface
    {
        $permission = $this->get($id);
        $permission->status = true;
        return $this->Permissions->save($permission);
    }

    /**
     * 無効状態にする
     *
     * @param int $id
     * @return EntityInterface
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function unpublish($id): EntityInterface
    {
        $permission = $this->get($id);
        $permission->status = false;
        return $this->Permissions->save($permission);
    }

    /**
     * 複製する
     *
     * @param int $permissionId
     * @return EntityInterface
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function copy(int $permissionId): EntityInterface
    {
        $permission = $this->get($permissionId);
        $permission->id = null;
        $permission->no = null;
        $permission->sort = null;
        $data = $permission->toarray();
        $data = $this->autoFillRecord($data);
        return $this->create($data);
    }



    /**
     * パーミッション情報を削除する
     * @param int $id
     * @return bool
     *
     * @checked
     * @noTodo
     * @unitTest
     */
    public function delete($id)
    {
        $Permission = $this->get($id);
        return $this->Permissions->delete($Permission);
    }

    /**
     * 許可・拒否を指定するメソッドのリストを取得
     *
     * @return array
     * @noTodo
     * @unitTest
     * @checked
     */
    public function getMethodList() : array
    {
        return $this->Permissions::METHOD_LIST;
    }

    /**
     *  レコード作成に必要なデータを代入する
     * @param array $data
     * @return array $data
     *
     * @noTodo
     * @unitTest
     * @checked
     */
    protected function autoFillRecord($data = []): array
    {
        if (empty($data['no'])) {
            $data['no'] = $this->Permissions->getMax('no') + 1;
        }
        if (empty($data['sort'])) {
            $data['sort'] = $this->Permissions->getMax('sort') + 1;
        }
        if (!isset($data['auth']) || $data['auth'] === null) {
            $data['auth'] = true;
        }
        if (empty($data['method'])) {
            $data['method'] = '*';
        }
        if (!isset($data['status']) || $data['status'] === null) {
            $data['status'] = true;
        }
        return $data;
    }
}