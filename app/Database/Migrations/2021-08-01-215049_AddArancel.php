<?php
use CodeIgniter\Database\Migration;

class AddArancel extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'fraccionarancelaria' => [
                'type' => 'INT',
                'constraint' => '11',
                'null' => false,
				'unique' => true
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'fechainicio' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
			'fechafin' => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null' => false,
            ],
			'umt' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => false,
            ],
			'imp' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => false,
            ],
			'exp' => [
                'type' => 'VARCHAR',
                'constraint' => 5,
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('arancel');
    }

    public function down()
    {
        $this->forge->dropTable('arancel');
    }
}
