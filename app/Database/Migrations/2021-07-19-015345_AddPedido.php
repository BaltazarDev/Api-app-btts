<?php
use CodeIgniter\Database\Migration;

class AddPedido extends Migration
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
            'npedimento' => [
                'type' => 'int',
                'constraint' => '11',
                'null' => false,
                'unique' => true
            ],
            'descripcion' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'psalida' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'pdestino' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'estatus' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => false
            ],
            'image_url' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
        'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('pedido');
    }

    public function down()
    {
        $this->forge->dropTable('pedido');
    }
}
