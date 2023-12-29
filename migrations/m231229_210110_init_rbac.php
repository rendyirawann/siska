<?php

use yii\db\Migration;

/**
 * Class m231229_210110_init_rbac
 */
class m231229_210110_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $createFiledoc = $auth->createPermission('createFiledoc');
        $createFiledoc->description = 'Tambah Filedoc';
        $auth->add($createFiledoc);

        $updateFiledoc = $auth->createPermission('updateFiledoc');
        $updateFiledoc->description = 'Ubah Filedoc';
        $auth->add($updateFiledoc);

        $readFiledoc = $auth->createPermission('readFiledoc');
        $readFiledoc->description = 'Lihat Filedoc';
        $auth->add($readFiledoc);

        $deleteFiledoc = $auth->createPermission('deleteFiledoc');
        $deleteFiledoc->description = 'Hapus Filedoc';
        $auth->add($deleteFiledoc);

        $adminRole = $auth->getRole('admin');
        $auth->addChild($adminRole, $createFiledoc);
        $auth->addChild($adminRole, $updateFiledoc);
        $auth->addChild($adminRole, $readFiledoc);
        $auth->addChild($adminRole, $deleteFiledoc);
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
        echo "m231229_210110_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
