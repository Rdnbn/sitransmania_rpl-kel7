@extends('layouts.app')

@section('title', 'Chat')

@section('content')

<h3 class="fw-bold mb-3">Chat Dengan {{ $target->nama }}</h3>

{{-- WRAPPER CHAT --}}
<div id="chat-box" class="card shadow p-3" style="height: 70vh; overflow-y: auto;">
    
    <div id="chat-messages">
        @foreach($pesan as $msg)
            <div class="mb-3 d-flex 
                {{ $msg->id_pengirim == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                
                <div class="p-2 rounded"
                    style="max-width: 70%; background: {{ $msg->id_pengirim == auth()->id() ? '#d1e7dd' : '#f8d7da' }}">

                    @if($msg->pesan)
                        <p class="mb-1">{{ $msg->pesan }}</p>
                    @endif

                    @if($msg->file)
                        <a href="{{ asset('uploads/chat/'.$msg->file) }}"
                        target="_blank" class="text-primary">📎 Lihat Lampiran</a>
                    @endif

                    <div class="text-muted small text-end">
                        {{ $msg->created_at }}
                    </div>

                </div>
            </div>
        @endforeach
    </div>

</div>

{{-- FORM KIRIM PESAN --}}
<form action="{{ route('chat.send') }}" method="POST" enctype="multipart/form-data"
      class="mt-3 d-flex gap-2">
    @csrf
    
    <input type="hidden" name="id_peminjaman" value="{{ $pinjam->id_peminjaman }}">
    <input type="hidden" name="id_penerima" value="{{ $target->id_user }}">

    <input type="text" name="pesan" class="form-control" placeholder="Ketik pesan..." autofocus>

    <input type="file" name="file" class="form-control" style="max-width:200px;">

    <button class="btn btn-primary">Kirim</button>
</form>

@endsection


{{-- SCRIPT AUTO REFRESH --}}
@section('scripts')
<script>
    const chatBox = document.getElementById('chat-box');
    const chatMessages = document.getElementById('chat-messages');
    const idPeminjaman = {{ $pinjam->id_peminjaman }};

    function loadMessages() {
        fetch('/chat/fetch/' + idPeminjaman)
            .then(response => response.json())
            .then(data => {
                chatMessages.innerHTML = '';

                data.forEach(msg => {
                    let isMe = msg.id_pengirim == {{ auth()->id() }};
                    let bubble = `
                        <div class="mb-3 d-flex ${isMe ? 'justify-content-end' : 'justify-content-start'}">
                            <div class="p-2 rounded"
                                 style="max-width:70%; background:${isMe ? '#d1e7dd' : '#f8d7da'}">
                                
                                ${msg.pesan ? `<p>${msg.pesan}</p>` : ''}

                                ${msg.file ? 
                                   `<a href="/uploads/chat/${msg.file}" target="_blank">📎 Lihat Lampiran</a>` 
                                   : ''}

                                <div class="text-muted small text-end">${msg.created_at}</div>
                            </div>
                        </div>
                    `;
                    chatMessages.innerHTML += bubble;
                });

                // AUTO SCROLL
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    }

    // Jalankan setiap 2.5 detik
    setInterval(loadMessages, 2500);

    // Scroll ke bawah saat halaman pertama kali dibuka
    window.onload = () => chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endsection
