<?php

class add_child_profile_photos
{
    private $lava;
    private $forge;

    public function __construct()
    {
        $this->lava = lava_instance();
        $this->lava->call->dbforge();
        $this->forge = $this->lava->dbforge;
    }

    public function up()
    {
        if (!$this->forge->column_exists('children', 'profile_photo')) {
            $this->forge->add_column('children', [
                'profile_photo' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                    'default' => null,
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->forge->column_exists('children', 'profile_photo')) {
            $this->forge->drop_column('children', 'profile_photo');
        }
    }
}
