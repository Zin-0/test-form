<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/management.css') }}" />
</head>

<body>
    <main>
        <h1>管理システム</h1>
        <form action="/search" method="post" class="form">
            @csrf
            <div class="search-top">
                <label for="fullname" class="search-content">お名前</label>
                <input type="text" name="fullname" id="fullname" class="name" />
                <span class="search-content">性別</span>
                <input type="radio" name="gender" value="0" id="all" class="gender" checked />
                <label for="all">全て</label>
                <input type="radio" name="gender" value="1" id="man" class="gender" />
                <label for="man">男性</label>
                <input type="radio" name="gender" value="2" id="woman" class="gender" />
                <label for="woman">女性</label>
            </div>
            <div class="search-middle">
                <label for="date_from" class="search-content">登録日</label>
                <input type="date" name="date_from" id="date_from" />
                <span> 〜 </span>
                <input type="date" name="date_to" id="date_to">
            </div>
            <div class="search-email">
                <label for="email" class="search-content">メールアドレス</label>
                <input type="text" name="email" id="email">
            </div>
            <div class="search-bottom">
                <button type="submit" name="action" value="post">検索</button><br>
                <button type="submit" formaction="/management" name="action" value="back">リセット</button>
            </div>
        </form>
        <div class="paginate">
            <div>
                @if (count($forms) > 0)
                    <p>
                        全{{ $forms->total() }}件中
                        {{ ($forms->currentPage() - 1) * $forms->perPage() + 1 }}~{{ ($forms->currentPage() - 1) * $forms->perPage() + 1 + (count($forms) - 1) }}件
                    </p>
                @else
                    <p>データがありません。</p>
                @endif
            </div>
            <div>
                {{ $forms->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <div class="form-table">
            <table>
                <tr class="table-title">
                    <th class="table-id">ID</th>
                    <th class="table-name">お名前</th>
                    <th class="table-gender">性別</th>
                    <th class="table-email">メールアドレス</th>
                    <th class="table-opinion">ご意見</th>
                    <th></th>
                </tr>
                @foreach ($forms as $form)
                    <form action="/delete" method="post">
                        @csrf
                        <tr>
                            <input type="hidden" name="firstPage" value="{{ $forms->url(1) }}">
                            <input type="hidden" name="currentPage" value="{{ $forms->currentPage() }}">
                            <td class="table-id"><input type="hidden" name="id" value="{{ $form->id }}">{{ $form->id }}</td>
                            <td class="table-name">{{ $form->fullname }}</td>
                            <td class="table-gender">
                                @if ($form->gender == '1')
                                    男性
                                @elseif ($form->gender == '2')
                                    女性
                                @endif
                            </td>
                            <td class="table-email">{{ $form->email }}</td>
                            <td class="opinion">{{ $form->opinion }}</td>
                            <td class="delete"><button type="submit">削除</button></td>
                        </tr>
                    </form>
                @endforeach
            </table>
        </div>
    </main>
</body>

</html>