<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}" />
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
</head>

<body>
    <main>
        <h1 class="contact-title">お問い合わせ</h1>
        <form class="form" action="/contacts/confirm" method="post">
            @csrf
            <div class="form-name">
                <label for="last-name" class="form-title">お名前</label>
                <input type="text" autocomplete="family-name" name="last-name" id="last-name" value="{{ old('last-name') }}" />
                <input type="text" autocomplete="given-name" name="first-name" id="first-name" value="{{ old('first-name') }}" />
            </div>
            <div class="subform">
                <span class="example-before"></span>
                <span class="example"> 例）山田</span>
                @error('last-name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                @if ($errors->has('last-name'))
                    <span class="Error" id="Error"></span>
                @else
                    <span class="jsError" id="jsError"></span>
                @endif
                <span class="example"> 例）太郎</span>
                @error('first-name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-gender">
                <span class="form-title">性別</span>
                <input type="radio" name="gender" value="1" id="man" checked />
                <label for="man">男性</label>
                <input type="radio" name="gender" value="2" id="woman" />
                <label for="woman">女性</label>
            </div>
            <div class="form-email">
                <label for="email" class="form-title">メールアドレス</label>
                <input type="text" name="email" id="email" value="{{ old('email') }}" />
            </div>
            <div class="subform">
                <span class="example-before"></span>
                <span class="example"> 例）test@example.com</span>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-postcode">
                    <label for="postcode" class="form-title">郵便番号</label>
                    <span> 〒 </span>
                    <input type="text" class="postcode-number" name="postcode" id="postcode" value="{{ old('postcode') }}" onKeyUp="AjaxZip3.zip2addr(this, '', 'address', 'address');" />
            </div>
            <div class="subform">
                <span class="example-before-postcode"></span>
                <span class="example"> 例）123-4567</span>
                @error('postcode')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-address">
                <label for="address" class="form-title">住所</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}" />
            </div>
            <div class="subform">
                <span class="example-before"></span>
                <span class="example"> 例）東京都渋谷区千駄ヶ谷1-2-3</span>
                @error('address')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-building_name">
                <label for="building_name" class="building-title">建物名</label>
                <input type="text" name="building_name" id="building_name" value="{{ old('building_name') }}">
            </div>
            <div class="subform">
                <span class="example-before"></span>
                <span class="example"> 例）千駄ヶ谷マンション101</span>
            </div>
            <div class="form-opinion">
                <label for="opinion" class="form-title">ご意見</label>
                <textarea name="opinion" id="opinion" cols="30" rows="10" maxlength="120">{{ old('opinion') }}</textarea>
                <span class="example-before"></span>
                @error('opinion')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="confirm">
                <button type="submit">確認</button>
            </div>
        </form>
    </main>
</body>

</html>