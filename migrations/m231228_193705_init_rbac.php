<?php

use yii\db\Migration;

/**
 * Class m231228_193705_init_rbac
 */
class m231228_193705_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Buat User';
        $auth->add($createUser);

        $updateUser = $auth->createPermission('updateUser');
        $updateUser->description = 'Ubah User';
        $auth->add($updateUser);

        $readUser = $auth->createPermission('readUser');
        $readUser->description = 'Lihat User';
        $auth->add($readUser);

        $deleteUser = $auth->createPermission('deleteUser');
        $deleteUser->description = 'Hapus User';
        $auth->add($deleteUser);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $updateUser);
        $auth->addChild($admin, $readUser);
        $auth->addChild($admin, $deleteUser);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $updateUser);
        $auth->addChild($user, $readUser);

        $auth->assign($admin, 3);
        $auth->assign($user, 2);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231228_193705_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
