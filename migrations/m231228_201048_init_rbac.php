<?php

use yii\db\Migration;

/**
 * Class m231228_201048_init_rbac
 */
class m231228_201048_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createJabatan = $auth->createPermission('createJabatan');
        $createJabatan->description = 'Buat Jabatan';
        $auth->add($createJabatan);

        $updateJabatan = $auth->createPermission('updateJabatan');
        $updateJabatan->description = 'Ubah Jabatan';
        $auth->add($updateJabatan);

        $readJabatan = $auth->createPermission('readJabatan');
        $readJabatan->description = 'Lihat Jabatan';
        $auth->add($readJabatan);

        $deleteJabatan = $auth->createPermission('deleteJabatan');
        $deleteJabatan->description = 'Hapus Jabatan';
        $auth->add($deleteJabatan);

        $adminRole = $auth->getRole('admin');
        $auth->addChild($adminRole, $createJabatan);
        $auth->addChild($adminRole, $updateJabatan);
        $auth->addChild($adminRole, $readJabatan);
        $auth->addChild($adminRole, $deleteJabatan);

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
        echo "m231228_201048_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
