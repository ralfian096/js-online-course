<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/docs/api', function () {
    $html = <<<'HTML'
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
    code, pre { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; }
    pre { background: #0b1020; color: #e5e7eb; padding: 14px; border-radius: 10px; overflow-x: auto; }
    .muted { color: #6b7280; }
    table { width: 100%; border-collapse: collapse; margin: 12px 0; }
    th, td { border: 1px solid #e5e7eb; padding: 10px; vertical-align: top; }
    th { text-align: left; background: #f9fafb; }
    .tag { display: inline-block; padding: 2px 8px; border-radius: 999px; background: #eef2ff; color: #3730a3; font-size: 12px; }
  </style>
</head>
<body>
  <h1>Dokumentasi API - Todo List</h1>
  <p class="muted">Base URL: <code>/api</code></p>

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
      <tr><td><code>GET</code></td><td><code>/api/todos</code></td><td>Lihat daftar todo list</td></tr>
      <tr><td><code>GET</code></td><td><code>/api/todos/{id}</code></td><td>Lihat detail todo list</td></tr>
      <tr><td><code>POST</code></td><td><code>/api/todos</code></td><td>Buat todo list baru</td></tr>
      <tr><td><code>PUT/PATCH</code></td><td><code>/api/todos/{id}</code></td><td>Edit todo list (title/description)</td></tr>
      <tr><td><code>PATCH</code></td><td><code>/api/todos/{id}/status</code></td><td>Update status todo list</td></tr>
      <tr><td><code>DELETE</code></td><td><code>/api/todos/{id}</code></td><td>Hapus todo list</td></tr>
    </tbody>
  </table>

  <h2>Detail Endpoint</h2>

  <h3>1) Lihat daftar todo list</h3>
  <p><code>GET /api/todos</code></p>
  <pre>curl -H "Accept: application/json" http://localhost:8000/api/todos</pre>
  <pre>{
  "data": [ { ...todo }, { ...todo } ]
}</pre>

  <h3>2) Lihat detail todo list</h3>
  <p><code>GET /api/todos/{id}</code></p>
  <pre>curl -H "Accept: application/json" http://localhost:8000/api/todos/1</pre>
  <pre>{
  "data": { ...todo }
}</pre>

  <h3>3) Buat todo list baru</h3>
  <p><code>POST /api/todos</code></p>
  <pre>curl -X POST http://localhost:8000/api/todos \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"title\":\"Belajar Laravel\",\"description\":\"CRUD Todo List\"}"</pre>
  <p class="muted">Request Body</p>
  <pre>{
  "title": "string (required, max 255)",
  "description": "string (optional)",
  "status": "done|not_done (optional, default not_done)"
}</pre>
  <p class="muted">Response (201)</p>
  <pre>{
  "message": "Todo created.",
  "data": { ...todo }
}</pre>

  <h3>4) Edit todo list</h3>
  <p><code>PUT/PATCH /api/todos/{id}</code></p>
  <pre>curl -X PATCH http://localhost:8000/api/todos/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"title\":\"Belajar Laravel 12\",\"description\":\"Update deskripsi\"}"</pre>
  <p class="muted">Request Body</p>
  <pre>{
  "title": "string (optional, max 255)",
  "description": "string|null (optional)"
}</pre>
  <p class="muted">Response (200)</p>
  <pre>{
  "message": "Todo updated.",
  "data": { ...todo }
}</pre>

  <h3>5) Update status todo list</h3>
  <p><code>PATCH /api/todos/{id}/status</code></p>
  <pre>curl -X PATCH http://localhost:8000/api/todos/1/status \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d "{\"status\":\"done\"}"</pre>
  <p class="muted">Request Body</p>
  <pre>{
  "status": "done|not_done (required)"
}</pre>
  <p class="muted">Response (200)</p>
  <pre>{
  "message": "Todo status updated.",
  "data": { ...todo }
}</pre>

  <h3>6) Hapus todo list</h3>
  <p><code>DELETE /api/todos/{id}</code></p>
  <pre>curl -X DELETE http://localhost:8000/api/todos/1 \
  -H "Accept: application/json"</pre>
  <pre>{
  "message": "Todo deleted."
}</pre>

  <h2>Error Response (Validasi)</h2>
  <p>Jika validasi gagal, API akan mengembalikan HTTP <code>422</code> dengan format seperti ini:</p>
  <pre>{
  "message": "The title field is required.",
  "errors": {
    "title": ["The title field is required."]
  }
}</pre>

  <p class="muted">Catatan: Pastikan header <code>Accept: application/json</code> agar response error berbentuk JSON.</p>
</body>
</html>
HTML;

    return response($html, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
});
