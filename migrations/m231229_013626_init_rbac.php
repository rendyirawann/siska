<?php

use yii\db\Migration;

/**
 * Class m231229_013626_init_rbac
 */
class m231229_013626_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createGaji = $auth->createPermission('createGaji');
        $createGaji->description = 'Buat Gaji';
        $auth->add($createGaji);

        $updateGaji = $auth->createPermission('updateGaji');
        $updateGaji->description = 'Ubah Gaji';
        $auth->add($updateGaji);

        $readGaji = $auth->createPermission('readGaji');
        $readGaji->description = 'Lihat Gaji';
        $auth->add($readGaji);

        $deleteGaji = $auth->createPermission('deleteGaji');
        $deleteGaji->description = 'Hapus Gaji';
        $auth->add($deleteGaji);

        $adminRole = $auth->getRole('admin');
        $auth->addChild($adminRole, $createGaji);
        $auth->addChild($adminRole, $updateGaji);
        $auth->addChild($adminRole, $readGaji);
        $auth->addChild($adminRole, $deleteGaji);
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
        echo "m231229_013626_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
