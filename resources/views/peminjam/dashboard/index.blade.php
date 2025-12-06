@extends('layouts.main')

@section('title', 'Beranda Peminjam')

@section('content')
<div style="background: linear-gradient(135deg, #f9f7f5 0%, #f5f3f1 100%); min-height: calc(100vh - 150px); padding: 3rem 2rem;">
    <div class="container">
        <!-- Welcome Section -->
        <div style="margin-bottom: 3rem;">
            <h1 style="color: #3d2817; font-weight: 700; font-size: 2.2rem; margin-bottom: 0.5rem;">
                <i class="bi bi-hand-thumbs-up"></i> Selamat Datang, {{ auth()->user()->nama ?? auth()->user()->name }}!
            </h1>
            <p style="color: #8B6354; font-size: 1rem;">
                Kelola peminjaman kendaraan dan pembayaran Anda dengan mudah
            </p>
        </div>

        <!-- Stats Summary -->
        <div class="row g-3 mb-4">
            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background: white; border-left: 4px solid #6C4E3F; border-radius: 10px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(108, 78, 63, 0.1); transition: all 0.3s ease;">
                    <div style="display: flex; justify-content: space-between;">
                        <div>
                            <p style="color: #8B6354; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 500;">Total Peminjaman</p>
                            <h3 style="color: #3d2817; font-size: 2rem; margin: 0;">{{ $totalPinjam }}</h3>
                        </div>
                        <i class="bi bi-car-front-fill" style="font-size: 2rem; color: #C9A58C; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background: white; border-left: 4px solid #C9A58C; border-radius: 10px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(108, 78, 63, 0.1); transition: all 0.3s ease;">
                    <div style="display: flex; justify-content: space-between;">
                        <div>
                            <p style="color: #8B6354; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 500;">Total Pembayaran</p>
                            <h3 style="color: #3d2817; font-size: 2rem; margin: 0;">{{ $totalPay }}</h3>
                        </div>
                        <i class="bi bi-credit-card" style="font-size: 2rem; color: #C9A58C; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="stat-card" style="background: white; border-left: 4px solid #6C4E3F; border-radius: 10px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(108, 78, 63, 0.1); transition: all 0.3s ease;">
                    <div style="display: flex; justify-content: space-between;">
                        <div>
                            <p style="color: #8B6354; font-size: 0.85rem; margin: 0 0 0.5rem 0; font-weight: 500;">Status Terakhir</p>
                            <h3 style="color: #3d2817; font-size: 1.2rem; margin: 0;">
                                @if($lastStatus)
                                    <span style="background: #E7D6C8; color: #6C4E3F; padding: 0.3rem 0.8rem; border-radius: 20px; font-size: 0.85rem; text-transform: capitalize;">
                                        {{ $lastStatus }}
                                    </span>
                                @else
                                    <span style="color: #C9A58C;">-</span>
                                @endif
                            </h3>
                        </div>
                        <i class="bi bi-info-circle" style="font-size: 2rem; color: #C9A58C; opacity: 0.8;"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Menu Cards -->
        <div style="margin-bottom: 4rem;">
            <h2 style="color: #3d2817; font-weight: 700; font-size: 1.5rem; margin-bottom: 2rem;">
                <i class="bi bi-grid-3x2-gap"></i> Menu Utama
            </h2>

            <div class="row g-3">
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('peminjam.browse.index') }}" class="dashboard-card" style="background: linear-gradient(135deg, rgba(108, 78, 63, 0.05) 0%, rgba(201, 165, 140, 0.05) 100%); border: 2px solid #E7D6C8; border-radius: 15px; padding: 2rem; text-align: center; cursor: pointer;">
                        <i class="bi bi-search" style="font-size: 3rem; color: #6C4E3F;"></i>
                        <h3 style="color: #3d2817; margin: 0;">Cari Kendaraan</h3>
                        <p style="color: #8B6354; font-size: 0.85rem;">Jelajahi daftar kendaraan yang tersedia</p>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="dashboard-card" style="background: linear-gradient(135deg, rgba(108, 78, 63, 0.05) 0%, rgba(201, 165, 140, 0.05) 100%); border: 2px solid #E7D6C8; border-radius: 15px; padding: 2rem; text-align: center; cursor: pointer;">
                        <i class="bi bi-file-earmark-text" style="font-size: 3rem; color: #6C4E3F;"></i>
                        <h3 style="color: #3d2817; margin: 0;">Peminjaman Saya</h3>
                        <p style="color: #8B6354; font-size: 0.85rem;">Kelola peminjaman aktif dan riwayat</p>
                    </a>
                </div>

                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="dashboard-card" style="background: linear-gradient(135deg, rgba(108, 78, 63, 0.05) 0%, rgba(201, 165, 140, 0.05) 100%); border: 2px solid #E7D6C8; border-radius: 15px; padding: 2rem; text-align: center; cursor: pointer;">
                        <i class="bi bi-wallet2" style="font-size: 3rem; color: #6C4E3F;"></i>
                        <h3 style="color: #3d2817; margin: 0;">Pembayaran</h3>
                        <p style="color: #8B6354; font-size: 0.85rem;">Kelola pembayaran dan tagihan</p>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a href="{{ route('peminjam.riwayat') }}" class="dashboard-card" style="background: linear-gradient(135deg, rgba(108, 78, 63, 0.05) 0%, rgba(201, 165, 140, 0.05) 100%); border: 2px solid #E7D6C8; border-radius: 15px; padding: 2rem; text-align: center; cursor: pointer;">
                        <i class="bi bi-clock-history" style="font-size: 3rem; color: #6C4E3F;"></i>
                        <h3 style="color: #3d2817; margin: 0;">Riwayat</h3>
                        <p style="color: #8B6354; font-size: 0.85rem;">Lihat riwayat aktivitas Anda</p>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="background: white; border-radius: 15px; padding: 2rem; box-shadow: 0 4px 12px rgba(108, 78, 63, 0.1);">
            <h3 style="color: #3d2817; font-weight: 700; font-size: 1.2rem; margin-bottom: 1.5rem;">
                <i class="bi bi-lightning-fill"></i> Akses Cepat
            </h3>
            
            <div class="row g-2">
                <div class="col-6 col-md-3">
                    <a href="{{ route('peminjam.browse.index') }}" class="quick-action-btn" style="background: linear-gradient(135deg, #6C4E3F 0%, #8B6354 100%); color: white; padding: 0.75rem 1rem; border-radius: 10px; display: block; text-align: center; font-weight: 600;">
                        <i class="bi bi-plus-circle"></i> Cari Kendaraan Baru
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="quick-action-btn" style="background: #E7D6C8; color: #3d2817; padding: 0.75rem 1rem; border-radius: 10px; display: block; text-align: center; font-weight: 600;">
                        <i class="bi bi-eye"></i> Lihat Status Pinjam
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('peminjam.peminjaman.index') }}" class="quick-action-btn" style="background: #E7D6C8; color: #3d2817; padding: 0.75rem 1rem; border-radius: 10px; display: block; text-align: center; font-weight: 600;">
                        <i class="bi bi-cash"></i> Bayar Tagihan
                    </a>
                </div>
                <div class="col-6 col-md-3">
                </div>
                <div class="col-6 col-md-3">
                    <a href="{{ route('support') }}" class="quick-action-btn" style="background: #E7D6C8; color: #3d2817; padding: 0.75rem 1rem; border-radius: 10px; display: block; text-align: center; font-weight: 600;">
                        <i class="bi bi-telephone"></i> Hubungi Support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .stat-card:hover {
        box-shadow: 0 4px 16px rgba(108, 78, 63, 0.15);
        transform: translateY(-2px);
    }
    
    .dashboard-card:hover {
        border-color: #6C4E3F;
        box-shadow: 0 8px 24px rgba(108, 78, 63, 0.15);
        transform: translateY(-3px);
    }
    
    .dashboard-card:hover > div:first-of-type {
        opacity: 1 !important;
    }
    
    .dashboard-card:hover i {
        color: #8B6354;
        transform: scale(1.1);
    }
    
    .quick-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 78, 63, 0.2);
    }
    
    @media (max-width: 768px) {
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .dashboard-card {
            min-height: 150px !important;
        }
    }
</style>
@endsection
