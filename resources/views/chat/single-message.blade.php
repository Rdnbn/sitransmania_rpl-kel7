@php
    $isMe = $msg->id_pengirim == auth()->id();
@endphp

<div class="mb-3 d-flex {{ $isMe ? 'justify-content-end' : 'justify-content-start' }}">
    
    <div class="p-2 rounded"
         style="max-width: 70%; background: {{ $isMe ? '#d1e7dd' : '#f8d7da' }}">

        {{-- Teks Pesan --}}
        @if($msg->pesan)
            <p class="mb-1">{{ $msg->pesan }}</p>
        @endif

        {{-- File Lampiran --}}
        @if($msg->file)
            <a href="{{ asset('uploads/chat/'.$msg->file) }}"
               target="_blank" class="text-primary">📎 Lihat Lampiran</a>
        @endif

        {{-- Timestamp --}}
        <div class="text-muted small text-end">
            {{ $msg->created_at->format('d M Y H:i') }}
        </div>

    </div>
</div>
