@php
$baseUrl = rtrim((string) config('app.url'), '/');
$apiBaseUrl = $baseUrl.'/api';
@endphp
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>API Docs - Todo List</title>
  <style>
    body { font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji","Segoe UI Emoji"; line-height: 1.5; padding: 24px; max-width: 1000px; margin: 0 auto; color: #111827; }
    h1, h2 { margin: 0 0 12px; }
    h2 { margin-top: 28px; }
    h3 { margin-top: 22px; }
    h4 { margin-top: 14px; margin-bottom: 8px; }
    code, pre { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
    pre { background: #0b1020; color: #e5e7eb; padding: 14px; border-radius: 10px; overflow-x: auto; }
    .muted { color: #6b7280; }
    table { width: 100%; border-collapse: collapse; margin: 12px 0; }
    th, td { border: 1px solid #e5e7eb; padding: 10px; vertical-align: top; }
    th { text-align: left; background: #f9fafb; }
    .tag { display: inline-block; padding: 2px 8px; border-radius: 999px; background: #eef2ff; color: #3730a3; font-size: 12px; }
    .card { border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; margin: 14px 0; }
    .grid { display: grid; grid-template-columns: 160px 1fr; gap: 8px 14px; margin: 10px 0 0; }
    .key { color: #374151; font-weight: 600; }
    .divider { height: 1px; background: #e5e7eb; margin: 16px 0; }
    .toc a { text-decoration: none; color: #111827; }
    .toc a:hover { text-decoration: underline; }
    .tabs { margin-top: 8px; }
    .tablist { display: inline-flex; border: 1px solid #e5e7eb; border-radius: 10px; overflow: hidden; background: #f9fafb; }
    .tab { appearance: none; border: 0; background: transparent; padding: 8px 12px; cursor: pointer; font-weight: 600; color: #374151; }
    .tab[aria-selected="true"] { background: #111827; color: #f9fafb; }
    .tabpanel { margin-top: 10px; }
    .tabpanel[hidden] { display: none; }
  </style>
</head>
<body>
  <h1>Dokumentasi API - Todo List</h1>
  <p class="muted">Base URL: <code>/api</code> (full URL dari APP_URL: <code>{{ $apiBaseUrl }}</code>)</p>

  <h2>Data Model</h2>
  <pre>{
  "id": 1,
  "title": "Belajar Laravel",
  "description": "CRUD Todo List",
  "status": "not_done",
  "created_at": "2026-06-06T11:06:21.000000Z",
  "updated_at": "2026-06-06T11:06:21.000000Z"
}</pre>
  <p><span class="tag">status</span> hanya menerima: <code>done</code> atau <code>not_done</code>.</p>

  <h2>Konvensi</h2>
  <div class="card">
    <div class="grid">
      <div class="key">Content-Type</div>
      <div><code>application/json</code> untuk request yang memakai body JSON (POST/PUT/PATCH).</div>
      <div class="key">Accept</div>
      <div><code>application/json</code> agar response selalu JSON (termasuk error).</div>
      <div class="key">Error umum</div>
      <div>
        <div><code>422</code> validasi gagal</div>
        <div><code>404</code> data tidak ditemukan</div>
        <div><code>405</code> method tidak didukung</div>
      </div>
    </div>
  </div>

  <h2>Ringkasan Endpoint</h2>
  <table>
    <thead>
      <tr>
        <th>Method</th>
        <th>Path</th>
        <th>Fungsi</th>
      </tr>
    </thead>
    <tbody>
      <tr><td><code>GET</code></td><td><code>/api/todos</code></td><td><a href="#get-todos">Lihat daftar todo list</a></td></tr>
      <tr><td><code>GET</code></td><td><code>/api/todos/{id}</code></td><td><a href="#get-todo">Lihat detail todo list</a></td></tr>
      <tr><td><code>POST</code></td><td><code>/api/todos</code></td><td><a href="#post-todos">Buat todo list baru</a></td></tr>
      <tr><td><code>PUT/PATCH</code></td><td><code>/api/todos/{id}</code></td><td><a href="#patch-todo">Edit todo list (title/description)</a></td></tr>
      <tr><td><code>PATCH</code></td><td><code>/api/todos/{id}/status</code></td><td><a href="#patch-todo-status">Update status todo list</a></td></tr>
      <tr><td><code>DELETE</code></td><td><code>/api/todos/{id}</code></td><td><a href="#delete-todo">Hapus todo list</a></td></tr>
    </tbody>
  </table>

  <h2>Detail Endpoint</h2>
  <div class="card toc">
    <div class="key">Daftar cepat</div>
    <div style="margin-top: 8px;">
      <a href="#get-todos">GET /api/todos</a> ·
      <a href="#get-todo">GET /api/todos/{id}</a> ·
      <a href="#post-todos">POST /api/todos</a> ·
      <a href="#patch-todo">PUT/PATCH /api/todos/{id}</a> ·
      <a href="#patch-todo-status">PATCH /api/todos/{id}/status</a> ·
      <a href="#delete-todo">DELETE /api/todos/{id}</a>
    </div>
  </div>

  <h3 id="get-todos">1) Lihat daftar todo list</h3>
  <div class="card">
    <div class="grid">
      <div class="key">Nama</div><div>List Todos</div>
      <div class="key">Pathname</div><div><code>/api/todos</code></div>
      <div class="key">HTTP Method</div><div><code>GET</code></div>
      <div class="key">Deskripsi</div><div>Mengambil seluruh todo, urut terbaru.</div>
    </div>
    <div class="divider"></div>
    <h4>Headers</h4>
    <table>
      <thead><tr><th>Header</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>Accept</code></td><td>Ya</td><td>Meminta response JSON.</td><td><code>application/json</code></td></tr>
      </tbody>
    </table>
    <h4>Payload / Query Parameter</h4>
    <p class="muted">Tidak ada payload body maupun query parameter.</p>
    <h4>Contoh Request</h4>
    <div class="tabs" data-tabs>
      <div class="tablist" role="tablist" aria-label="Contoh request list todos">
        <button class="tab" type="button" role="tab" aria-selected="true" data-tab="curl">CURL</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="php">PHP</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="js">JS</button>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="curl">
        <pre>curl -H "Accept: application/json" {{ $apiBaseUrl }}/todos</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="php" hidden>
        <pre>$ch = curl_init('{{ $apiBaseUrl }}/todos');
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER =&gt; true,
  CURLOPT_HTTPHEADER =&gt; ['Accept: application/json'],
]);
$response = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $status . PHP_EOL;
echo $response;</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="js" hidden>
        <pre>fetch('{{ $apiBaseUrl }}/todos', {
  headers: { 'Accept': 'application/json' }
})
  .then(async (res) =&gt; ({ status: res.status, body: await res.json() }))
  .then(console.log);</pre>
      </div>
    </div>
    <h4>Contoh Response</h4>
    <p class="muted">Success (200)</p>
    <pre>{
  "data": [
    {
      "id": 1,
      "title": "Belajar Laravel",
      "description": "CRUD Todo List",
      "status": "not_done",
      "created_at": "2026-06-06T11:06:21.000000Z",
      "updated_at": "2026-06-06T11:06:21.000000Z"
    }
  ]
}</pre>
  </div>

  <h3 id="get-todo">2) Lihat detail todo list</h3>
  <div class="card">
    <div class="grid">
      <div class="key">Nama</div><div>Get Todo Detail</div>
      <div class="key">Pathname</div><div><code>/api/todos/{id}</code></div>
      <div class="key">HTTP Method</div><div><code>GET</code></div>
      <div class="key">Deskripsi</div><div>Mengambil detail 1 todo berdasarkan ID.</div>
    </div>
    <div class="divider"></div>
    <h4>Headers</h4>
    <table>
      <thead><tr><th>Header</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>Accept</code></td><td>Ya</td><td>Meminta response JSON.</td><td><code>application/json</code></td></tr>
      </tbody>
    </table>
    <h4>Payload / Requirement</h4>
    <table>
      <thead><tr><th>Parameter</th><th>Lokasi</th><th>Tipe</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>id</code></td><td>Path</td><td>integer</td><td>Ya</td><td>ID todo.</td><td><code>1</code></td></tr>
      </tbody>
    </table>
    <h4>Contoh Request</h4>
    <div class="tabs" data-tabs>
      <div class="tablist" role="tablist" aria-label="Contoh request get todo">
        <button class="tab" type="button" role="tab" aria-selected="true" data-tab="curl">CURL</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="php">PHP</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="js">JS</button>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="curl">
        <pre>curl -H "Accept: application/json" {{ $apiBaseUrl }}/todos/1</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="php" hidden>
        <pre>$id = 1;
$ch = curl_init("{{ $apiBaseUrl }}/todos/$id");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER =&gt; true,
  CURLOPT_HTTPHEADER =&gt; ['Accept: application/json'],
]);
echo curl_exec($ch);
curl_close($ch);</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="js" hidden>
        <pre>const id = 1;
fetch(`{{ $apiBaseUrl }}/todos/${id}`, {
  headers: { 'Accept': 'application/json' }
})
  .then(async (res) =&gt; ({ status: res.status, body: await res.json() }))
  .then(console.log);</pre>
      </div>
    </div>
    <h4>Contoh Response</h4>
    <p class="muted">Success (200)</p>
    <pre>{
  "data": {
    "id": 1,
    "title": "Belajar Laravel",
    "description": "CRUD Todo List",
    "status": "not_done",
    "created_at": "2026-06-06T11:06:21.000000Z",
    "updated_at": "2026-06-06T11:06:21.000000Z"
  }
}</pre>
    <p class="muted">Error (404) jika ID tidak ditemukan</p>
    <pre>{
  "message": "Not Found"
}</pre>
  </div>

  <h3 id="post-todos">3) Buat todo list baru</h3>
  <div class="card">
    <div class="grid">
      <div class="key">Nama</div><div>Create Todo</div>
      <div class="key">Pathname</div><div><code>/api/todos</code></div>
      <div class="key">HTTP Method</div><div><code>POST</code></div>
      <div class="key">Deskripsi</div><div>Membuat todo baru.</div>
    </div>
    <div class="divider"></div>
    <h4>Headers</h4>
    <table>
      <thead><tr><th>Header</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>Accept</code></td><td>Ya</td><td>Meminta response JSON.</td><td><code>application/json</code></td></tr>
        <tr><td><code>Content-Type</code></td><td>Ya</td><td>Tipe body request.</td><td><code>application/json</code></td></tr>
      </tbody>
    </table>
    <h4>Payload &amp; Requirement</h4>
    <table>
      <thead><tr><th>Field</th><th>Tipe</th><th>Wajib</th><th>Rules</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>title</code></td><td>string</td><td>Ya</td><td>max 255</td><td><code>"Belajar Laravel"</code></td></tr>
        <tr><td><code>description</code></td><td>string</td><td>Tidak</td><td>-</td><td><code>"CRUD Todo List"</code></td></tr>
        <tr><td><code>status</code></td><td>string</td><td>Tidak</td><td>in: done, not_done (default: not_done)</td><td><code>"not_done"</code></td></tr>
      </tbody>
    </table>
    <h4>Contoh Payload JSON</h4>
    <pre>{
  "title": "Belajar Laravel",
  "description": "CRUD Todo List",
  "status": "not_done"
}</pre>
    <h4>Contoh Request</h4>
    <div class="tabs" data-tabs>
      <div class="tablist" role="tablist" aria-label="Contoh request create todo">
        <button class="tab" type="button" role="tab" aria-selected="true" data-tab="curl">CURL</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="php">PHP</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="js">JS</button>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="curl">
        <pre>curl -X POST {{ $apiBaseUrl }}/todos \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"title\":\"Belajar Laravel\",\"description\":\"CRUD Todo List\",\"status\":\"not_done\"}"</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="php" hidden>
        <pre>$payload = json_encode([
  'title' =&gt; 'Belajar Laravel',
  'description' =&gt; 'CRUD Todo List',
  'status' =&gt; 'not_done',
]);

$ch = curl_init('{{ $apiBaseUrl }}/todos');
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER =&gt; true,
  CURLOPT_CUSTOMREQUEST =&gt; 'POST',
  CURLOPT_POSTFIELDS =&gt; $payload,
  CURLOPT_HTTPHEADER =&gt; [
    'Accept: application/json',
    'Content-Type: application/json',
  ],
]);
echo curl_exec($ch);
curl_close($ch);</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="js" hidden>
        <pre>fetch('{{ $apiBaseUrl }}/todos', {
  method: 'POST',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({
    title: 'Belajar Laravel',
    description: 'CRUD Todo List',
    status: 'not_done'
  })
})
  .then(async (res) =&gt; ({ status: res.status, body: await res.json() }))
  .then(console.log);</pre>
      </div>
    </div>
    <h4>Contoh Response</h4>
    <p class="muted">Success (201)</p>
    <pre>{
  "message": "Todo created.",
  "data": {
    "id": 1,
    "title": "Belajar Laravel",
    "description": "CRUD Todo List",
    "status": "not_done",
    "created_at": "2026-06-06T11:06:21.000000Z",
    "updated_at": "2026-06-06T11:06:21.000000Z"
  }
}</pre>
    <p class="muted">Error (422) validasi gagal</p>
    <pre>{
  "message": "The title field is required.",
  "errors": {
    "title": [
      "The title field is required."
    ]
  }
}</pre>
  </div>

  <h3 id="patch-todo">4) Edit todo list</h3>
  <div class="card">
    <div class="grid">
      <div class="key">Nama</div><div>Update Todo</div>
      <div class="key">Pathname</div><div><code>/api/todos/{id}</code></div>
      <div class="key">HTTP Method</div><div><code>PUT</code> atau <code>PATCH</code></div>
      <div class="key">Deskripsi</div><div>Mengubah data todo (hanya title/description).</div>
    </div>
    <div class="divider"></div>
    <h4>Headers</h4>
    <table>
      <thead><tr><th>Header</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>Accept</code></td><td>Ya</td><td>Meminta response JSON.</td><td><code>application/json</code></td></tr>
        <tr><td><code>Content-Type</code></td><td>Ya</td><td>Tipe body request.</td><td><code>application/json</code></td></tr>
      </tbody>
    </table>
    <h4>Payload &amp; Requirement</h4>
    <table>
      <thead><tr><th>Field</th><th>Tipe</th><th>Wajib</th><th>Rules</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>title</code></td><td>string</td><td>Tidak</td><td>max 255 (jika ada, tidak boleh kosong)</td><td><code>"Belajar Laravel 12"</code></td></tr>
        <tr><td><code>description</code></td><td>string|null</td><td>Tidak</td><td>boleh null</td><td><code>"Update deskripsi"</code> / <code>null</code></td></tr>
      </tbody>
    </table>
    <h4>Contoh Payload JSON</h4>
    <pre>{
  "title": "Belajar Laravel 12",
  "description": "Update deskripsi"
}</pre>
    <h4>Contoh Request</h4>
    <div class="tabs" data-tabs>
      <div class="tablist" role="tablist" aria-label="Contoh request update todo">
        <button class="tab" type="button" role="tab" aria-selected="true" data-tab="curl">CURL</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="php">PHP</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="js">JS</button>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="curl">
        <pre>curl -X PATCH {{ $apiBaseUrl }}/todos/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"title\":\"Belajar Laravel 12\",\"description\":\"Update deskripsi\"}"</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="php" hidden>
        <pre>$id = 1;
$payload = json_encode([
  'title' =&gt; 'Belajar Laravel 12',
  'description' =&gt; 'Update deskripsi',
]);

$ch = curl_init("{{ $apiBaseUrl }}/todos/$id");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER =&gt; true,
  CURLOPT_CUSTOMREQUEST =&gt; 'PATCH',
  CURLOPT_POSTFIELDS =&gt; $payload,
  CURLOPT_HTTPHEADER =&gt; [
    'Accept: application/json',
    'Content-Type: application/json',
  ],
]);
echo curl_exec($ch);
curl_close($ch);</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="js" hidden>
        <pre>const id = 1;
fetch(`{{ $apiBaseUrl }}/todos/${id}`, {
  method: 'PATCH',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ title: 'Belajar Laravel 12', description: 'Update deskripsi' })
})
  .then(async (res) =&gt; ({ status: res.status, body: await res.json() }))
  .then(console.log);</pre>
      </div>
    </div>
    <h4>Contoh Response</h4>
    <p class="muted">Success (200)</p>
    <pre>{
  "message": "Todo updated.",
  "data": {
    "id": 1,
    "title": "Belajar Laravel 12",
    "description": "Update deskripsi",
    "status": "not_done",
    "created_at": "2026-06-06T11:06:21.000000Z",
    "updated_at": "2026-06-06T11:10:00.000000Z"
  }
}</pre>
    <p class="muted">Error (404) jika ID tidak ditemukan</p>
    <pre>{
  "message": "Not Found"
}</pre>
    <p class="muted">Error (422) jika validasi gagal</p>
    <pre>{
  "message": "The title field is required.",
  "errors": {
    "title": [
      "The title field is required."
    ]
  }
}</pre>
  </div>

  <h3 id="patch-todo-status">5) Update status todo list</h3>
  <div class="card">
    <div class="grid">
      <div class="key">Nama</div><div>Update Todo Status</div>
      <div class="key">Pathname</div><div><code>/api/todos/{id}/status</code></div>
      <div class="key">HTTP Method</div><div><code>PATCH</code></div>
      <div class="key">Deskripsi</div><div>Mengubah status todo menjadi <code>done</code> atau <code>not_done</code>.</div>
    </div>
    <div class="divider"></div>
    <h4>Headers</h4>
    <table>
      <thead><tr><th>Header</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>Accept</code></td><td>Ya</td><td>Meminta response JSON.</td><td><code>application/json</code></td></tr>
        <tr><td><code>Content-Type</code></td><td>Ya</td><td>Tipe body request.</td><td><code>application/json</code></td></tr>
      </tbody>
    </table>
    <h4>Payload &amp; Requirement</h4>
    <table>
      <thead><tr><th>Field</th><th>Tipe</th><th>Wajib</th><th>Rules</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>status</code></td><td>string</td><td>Ya</td><td>in: done, not_done</td><td><code>"done"</code></td></tr>
      </tbody>
    </table>
    <h4>Contoh Payload JSON</h4>
    <pre>{
  "status": "done"
}</pre>
    <h4>Contoh Request</h4>
    <div class="tabs" data-tabs>
      <div class="tablist" role="tablist" aria-label="Contoh request update status">
        <button class="tab" type="button" role="tab" aria-selected="true" data-tab="curl">CURL</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="php">PHP</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="js">JS</button>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="curl">
        <pre>curl -X PATCH {{ $apiBaseUrl }}/todos/1/status \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"status\":\"done\"}"</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="php" hidden>
        <pre>$id = 1;
$payload = json_encode(['status' =&gt; 'done']);

$ch = curl_init("{{ $apiBaseUrl }}/todos/$id/status");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER =&gt; true,
  CURLOPT_CUSTOMREQUEST =&gt; 'PATCH',
  CURLOPT_POSTFIELDS =&gt; $payload,
  CURLOPT_HTTPHEADER =&gt; [
    'Accept: application/json',
    'Content-Type: application/json',
  ],
]);
echo curl_exec($ch);
curl_close($ch);</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="js" hidden>
        <pre>const id = 1;
fetch(`{{ $apiBaseUrl }}/todos/${id}/status`, {
  method: 'PATCH',
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  },
  body: JSON.stringify({ status: 'done' })
})
  .then(async (res) =&gt; ({ status: res.status, body: await res.json() }))
  .then(console.log);</pre>
      </div>
    </div>
    <h4>Contoh Response</h4>
    <p class="muted">Success (200)</p>
    <pre>{
  "message": "Todo status updated.",
  "data": {
    "id": 1,
    "title": "Belajar Laravel",
    "description": "CRUD Todo List",
    "status": "done",
    "created_at": "2026-06-06T11:06:21.000000Z",
    "updated_at": "2026-06-06T11:12:00.000000Z"
  }
}</pre>
    <p class="muted">Error (422) jika status bukan done/not_done</p>
    <pre>{
  "message": "The selected status is invalid.",
  "errors": {
    "status": [
      "The selected status is invalid."
    ]
  }
}</pre>
  </div>

  <h3 id="delete-todo">6) Hapus todo list</h3>
  <div class="card">
    <div class="grid">
      <div class="key">Nama</div><div>Delete Todo</div>
      <div class="key">Pathname</div><div><code>/api/todos/{id}</code></div>
      <div class="key">HTTP Method</div><div><code>DELETE</code></div>
      <div class="key">Deskripsi</div><div>Menghapus 1 todo berdasarkan ID.</div>
    </div>
    <div class="divider"></div>
    <h4>Headers</h4>
    <table>
      <thead><tr><th>Header</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>Accept</code></td><td>Ya</td><td>Meminta response JSON.</td><td><code>application/json</code></td></tr>
      </tbody>
    </table>
    <h4>Payload / Requirement</h4>
    <table>
      <thead><tr><th>Parameter</th><th>Lokasi</th><th>Tipe</th><th>Wajib</th><th>Deskripsi</th><th>Contoh</th></tr></thead>
      <tbody>
        <tr><td><code>id</code></td><td>Path</td><td>integer</td><td>Ya</td><td>ID todo.</td><td><code>1</code></td></tr>
      </tbody>
    </table>
    <h4>Contoh Request</h4>
    <div class="tabs" data-tabs>
      <div class="tablist" role="tablist" aria-label="Contoh request delete todo">
        <button class="tab" type="button" role="tab" aria-selected="true" data-tab="curl">CURL</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="php">PHP</button>
        <button class="tab" type="button" role="tab" aria-selected="false" data-tab="js">JS</button>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="curl">
        <pre>curl -X DELETE {{ $apiBaseUrl }}/todos/1 -H "Accept: application/json"</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="php" hidden>
        <pre>$id = 1;
$ch = curl_init("{{ $apiBaseUrl }}/todos/$id");
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER =&gt; true,
  CURLOPT_CUSTOMREQUEST =&gt; 'DELETE',
  CURLOPT_HTTPHEADER =&gt; ['Accept: application/json'],
]);
echo curl_exec($ch);
curl_close($ch);</pre>
      </div>
      <div class="tabpanel" role="tabpanel" data-panel="js" hidden>
        <pre>const id = 1;
fetch(`{{ $apiBaseUrl }}/todos/${id}`, {
  method: 'DELETE',
  headers: { 'Accept': 'application/json' }
})
  .then(async (res) =&gt; ({ status: res.status, body: await res.json() }))
  .then(console.log);</pre>
      </div>
    </div>
    <h4>Contoh Response</h4>
    <p class="muted">Success (200)</p>
    <pre>{
  "message": "Todo deleted."
}</pre>
    <p class="muted">Error (404) jika ID tidak ditemukan</p>
    <pre>{
  "message": "Not Found"
}</pre>
  </div>

  <h2>Format Error Validasi (422)</h2>
  <p class="muted">Semua endpoint yang memvalidasi input akan mengembalikan format ini saat gagal.</p>
  <pre>{
  "message": "The title field is required.",
  "errors": {
    "title": [
      "The title field is required."
    ]
  }
}</pre>
  <p class="muted">Pastikan selalu mengirim header <code>Accept: application/json</code>.</p>

  <script>
    (function () {
      function initTabs(container) {
        const tabs = Array.from(container.querySelectorAll('[role="tab"]'));
        const panels = Array.from(container.querySelectorAll('[role="tabpanel"]'));
        function activate(name) {
          tabs.forEach((t) => t.setAttribute('aria-selected', t.dataset.tab === name ? 'true' : 'false'));
          panels.forEach((p) => {
            const isActive = p.dataset.panel === name;
            if (isActive) p.removeAttribute('hidden'); else p.setAttribute('hidden', 'hidden');
          });
        }
        tabs.forEach((tab) => {
          tab.addEventListener('click', () => activate(tab.dataset.tab));
        });
        activate('curl');
      }
      document.querySelectorAll('[data-tabs]').forEach(initTabs);
    })();
  </script>
</body>
</html>
