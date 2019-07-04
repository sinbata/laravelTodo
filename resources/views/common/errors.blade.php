@if (count($errors) > 0)
<!-- フォームのエラーリスト -->
<!-- 
@から始まるものはbladeのディレクティブ
-->
<div class="alert alert-danger">
    <strong>WRONG</strong>

    <br><br>

    <ul>
        @foreach ($errors->all() as $error)
        <!-- エラーを全て表示 -->
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif