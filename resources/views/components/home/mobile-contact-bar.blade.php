@php
    $header = \App\Models\HeaderSetting::first(); // reuse phone/email/logo
@endphp
<div class="bottom-contacts d-block d-md-none pb-1 pt-1">
    <ul class="m-0 p-0">
        <li>
            <a id="goidien" href="tel:{{ $header->phone }}">
                <div class="icon-wrapper">
                    <i class="bi bi-telephone-fill"></i>
                </div>
                <span>Gọi điện</span>
            </a>
        </li>
        <li>
            <a id="nhantin" href="sms:{{ $header->phone }}">
                <div class="icon-wrapper">
                    <i class="bi bi-chat-dots-fill"></i>
                </div>
                <span>Nhắn tin</span>
            </a>
        </li>
        <li>
            <a id="chatzalo" href="https://zalo.me/{{ $header->phone }}">
                <div class="icon-wrapper">
                    <img src="{{ asset('icons/zalo_icon.png') }}" alt="Zalo" class="zalo-icon">
                </div>
                <span>Zalo</span>
            </a>
        </li>
        <li>
            <a id="chatfb" href="{{ $header->facebook_url }}">
                <div class="icon-wrapper">
                    <i class="bi bi-messenger"></i>
                </div>
                <span>Messenger</span>
            </a>
        </li>
    </ul>
</div>



<style>
    .bottom-contacts {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 9999;
        background: #fff;
        border-top: 1px solid #ddd;
        box-shadow: 0 -1px 5px rgba(0,0,0,0.1);
    }

    .bottom-contacts ul {
        display: flex;
        justify-content: space-around;
        align-items: center;
        list-style: none;
        padding: 6px 0;
        margin: 0;
    }

    .bottom-contacts li {
        text-align: center;
        flex: 1;
    }

    .bottom-contacts a {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 12px;
        color: #000;
    }

    .bottom-contacts .icon-wrapper {
        height: 30px;
        width: 30px;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .bottom-contacts .icon-wrapper i {
        font-size: 26px;
        color: #007bff;
    }

    .bottom-contacts .zalo-icon {
        height: 26px;
        width: 26px;
        object-fit: contain;
        display: block;
    }

    .bottom-contacts span {
        font-weight: 500;
        line-height: 1;
        margin-top: 2px;
    }
</style>
