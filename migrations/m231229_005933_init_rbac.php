<?php

use yii\db\Migration;

/**
 * Class m231229_005933_init_rbac
 */
class m231229_005933_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $createProfile = $auth->createPermission('createProfile');
        $createProfile->description = 'Buat Profil';
        $auth->add($createProfile);

        $updateProfile = $auth->createPermission('updateProfile');
        $updateProfile->description = 'Ubah Profil';
        $auth->add($updateProfile);

        $readProfile = $auth->createPermission('readProfile');
        $readProfile->description = 'Lihat Profil';
        $auth->add($readProfile);

        $deleteProfile = $auth->createPermission('deleteProfile');
        $deleteProfile->description = 'Hapus Profil';
        $auth->add($deleteProfile);

        $adminRole = $auth->getRole('admin');
        $auth->addChild($adminRole, $createProfile);
        $auth->addChild($adminRole, $updateProfile);
        $auth->addChild($adminRole, $readProfile);
        $auth->addChild($adminRole, $deleteProfile);

        $userRole = $auth->getRole('user');
        $auth->addChild($userRole, $readProfile);
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
        echo "m231229_005933_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
