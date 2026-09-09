<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Kategori;
use App\Models\Informasi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KnowledgeHubTest extends TestCase
{
    use RefreshDatabase;

    protected Kategori $kategori;

    protected function setUp(): void
    {
        parent::setUp();
        $this->kategori = Kategori::create([
            'nama' => 'Teknologi Informasi',
            'deskripsi' => 'Kategori testing untuk TI',
        ]);
    }

    public function test_dashboard_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Knowledge Hub Mini');
    }

    public function test_public_user_can_view_published_knowledge(): void
    {
        Informasi::create([
            'kategori_id' => $this->kategori->id,
            'judul' => 'Published Article Title',
            'ringkasan' => 'Summary of published article',
            'isi' => 'Content of published article',
            'status' => 'published',
        ]);

        $response = $this->get('/knowledge');
        $response->assertStatus(200);
        $response->assertSee('Published Article Title');
    }

    public function test_public_user_cannot_access_draft_detail(): void
    {
        $draft = Informasi::create([
            'kategori_id' => $this->kategori->id,
            'judul' => 'Secret Draft Knowledge',
            'ringkasan' => 'Draf rahasia',
            'isi' => 'Konten rahasia belum rilis',
            'status' => 'draft',
        ]);

        $response = $this->get('/knowledge/' . $draft->id);
        $response->assertStatus(404);
    }

    public function test_public_user_can_access_published_detail(): void
    {
        $published = Informasi::create([
            'kategori_id' => $this->kategori->id,
            'judul' => 'Prinsip RESTful API',
            'ringkasan' => 'Ringkasan artikel',
            'isi' => 'Isi lengkap artikel RESTful API',
            'status' => 'published',
        ]);

        $response = $this->get('/knowledge/' . $published->id);
        $response->assertStatus(200);
        $response->assertSee('Prinsip RESTful API');
    }

    public function test_admin_can_crud_informasi(): void
    {
        $kategori = $this->kategori;

        // 1. Index
        $response = $this->get('/informasi');
        $response->assertStatus(200);

        // 2. Create Page
        $response = $this->get('/informasi/tambah');
        $response->assertStatus(200);

        // 3. Store (POST + CSRF)
        $storeData = [
            'judul' => 'Testing Pengetahuan Baru',
            'kategori_id' => $kategori->id,
            'ringkasan' => 'Ini adalah ringkasan testing otomatis.',
            'isi' => 'Ini adalah isi lengkap untuk testing otomatis dari Laravel test suite.',
            'sumber' => 'https://example.com',
            'status' => 'published',
        ];
        $response = $this->post('/informasi', $storeData);
        $response->assertRedirect('/informasi');
        $response->assertSessionHas('sukses');

        $created = Informasi::where('judul', 'Testing Pengetahuan Baru')->first();
        $this->assertNotNull($created);

        // 4. Show (Detail)
        $response = $this->get('/informasi/' . $created->id);
        $response->assertStatus(200);
        $response->assertSee('Testing Pengetahuan Baru');

        // 5. Edit Page
        $response = $this->get('/informasi/' . $created->id . '/ubah');
        $response->assertStatus(200);

        // 6. Update (PUT)
        $response = $this->put('/informasi/' . $created->id, [
            'judul' => 'Testing Pengetahuan Diperbarui',
            'kategori_id' => $kategori->id,
            'ringkasan' => 'Ringkasan sudah diupdate.',
            'isi' => 'Isi sudah diupdate.',
            'sumber' => 'https://updated.com',
            'status' => 'draft',
        ]);
        $response->assertRedirect('/informasi');
        $this->assertDatabaseHas('informasis', [
            'id' => $created->id,
            'judul' => 'Testing Pengetahuan Diperbarui',
            'status' => 'draft',
        ]);

        // 7. Destroy (DELETE)
        $response = $this->delete('/informasi/' . $created->id);
        $response->assertRedirect('/informasi');
        $this->assertDatabaseMissing('informasis', [
            'id' => $created->id,
        ]);
    }

    public function test_validation_rejects_empty_inputs(): void
    {
        $response = $this->post('/informasi', []);
        $response->assertSessionHasErrors(['judul', 'kategori_id', 'isi', 'status']);
    }
}
