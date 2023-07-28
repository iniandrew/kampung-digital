@extends('layouts.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{$titlePage}}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Aduan</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('complaint.index') }}">List Aduan</a></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Detail Aduan {{ $complaint->title }}</h4>
                </div>
                <div class="card-body">
                    <main class="msger-chat">
                        <div class="msg right-msg">
                            <div class="msg-img"
                                 style="background-image: url(https://www.pngkit.com/png/full/281-2812821_user-account-management-logo-user-icon-png.png)">
                            </div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ $complaint->user->name }}</div>
                                    <div class="msg-info-time">{{ date('d M, Y', strtotime($complaint->created_at)) }}</div>
                                </div>
                                <div class="msg-text">
                                    {{ $complaint->content }}
                                </div>
                            </div>
                        </div>
                        <div class="msg right-msg">
                            <div class="msg-img"
                                 style="background-image: url(https://www.pngkit.com/png/full/281-2812821_user-account-management-logo-user-icon-png.png)">
                            </div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ $complaint->user->name }}</div>
                                    <div class="msg-info-time">{{ date('d M, Y', strtotime($complaint->created_at)) }}</div>
                                </div>
                                <div class="msg-text">
                                    Bukti Aduan<br>
                                    <a href="{{ $complaint->proof }}" target="_blank"><img src="{{ $complaint->proof }}" alt="" width="30%"></a>
                                </div>
                            </div>
                        </div>
                        @if($complaint->response)
                            <div class="msg left-msg">
                                <div class="msg-img"
                                     style="background-image: url(https://th.bing.com/th/id/OIP.lXLBjGaneyPrkTzJsdtqjgHaHa?pid=ImgDet&w=512&h=512&rs=1)">
                                </div>
                                <div class="msg-bubble">
                                    <div class="msg-info">
                                        <div class="msg-info-name">{{ $complaint->response->user->name }}</div>
                                        <div class="msg-info-time">{{ date('d M, Y', strtotime($complaint->response->created_at)) }}</div>
                                    </div>
                                    <div class="msg-text">
                                        {{ $complaint->response->content }}
                                    </div>
                                </div>
                            </div>
                            @if($complaint->response->attachment)
                                <div class="msg left-msg">
                                    <div class="msg-img" style="background-image: url(https://th.bing.com/th/id/OIP.lXLBjGaneyPrkTzJsdtqjgHaHa?pid=ImgDet&w=512&h=512&rs=1)">
                                    </div>
                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">{{ $complaint->response->user->name }}</div>
                                            <div class="msg-info-time">{{ date('d M, Y', strtotime($complaint->response->created_at)) }}</div>
                                        </div>
                                        <div class="msg-text">
                                            Bukti Tanggapan<br>
                                            <a href="{{ $complaint->response->proof }}" target="_blank"><img src="{{ $complaint->response->proof }}" alt="" width="30%"></a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </main>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('complaint.index') }}" class="btn btn-danger">Kembali</a>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('style')
    <style>
        :root {
            --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --msger-bg: #fff;
            --border: 2px solid #ddd;
            --left-msg-bg: #ececec;
            --right-msg-bg: #579ffb;
        }

        .msger {
            display: flex;
            flex-flow: column wrap;
            justify-content: space-between;
            width: 100%;
            max-width: 867px;
            margin: 25px 10px;
            height: calc(100% - 50px);
            border: var(--border);
            border-radius: 5px;
            background: var(--msger-bg);
            box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
        }


        .msger-chat {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }
        .msger-chat::-webkit-scrollbar {
            width: 6px;
        }
        .msger-chat::-webkit-scrollbar-track {
            background: #ddd;
        }
        .msger-chat::-webkit-scrollbar-thumb {
            background: #bdbdbd;
        }
        .msg {
            display: flex;
            align-items: flex-end;
            margin-bottom: 10px;
        }
        .msg:last-of-type {
            margin: 0;
        }
        .msg-img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            background: #ddd;
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            border-radius: 50%;
        }
        .msg-bubble {
            max-width: 450px;
            padding: 15px;
            border-radius: 15px;
            background: var(--left-msg-bg);
        }
        .msg-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .msg-info-name {
            margin-right: 10px;
            font-weight: bold;
        }
        .msg-info-time {
            font-size: 0.85em;
        }

        .left-msg .msg-bubble {
            border-bottom-left-radius: 0;
        }

        .right-msg {
            flex-direction: row-reverse;
        }
        .right-msg .msg-bubble {
            background: var(--right-msg-bg);
            color: #fff;
            border-bottom-right-radius: 0;
        }
        .right-msg .msg-img {
            margin: 0 0 0 10px;
        }
    </style>
@endpush
