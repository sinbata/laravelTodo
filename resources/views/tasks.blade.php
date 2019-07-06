@extends('layouts.home')
@section('content')
<!-- 
    section - endsectionまでをlayouts/homeに挿入
 -->
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                New Task
            </div>

            <div class="panel-body">
                <!-- Display Validation Errors -->
                <!-- bladeビューを読み込み　入出力エラーをcommon.errorsに共通化 -->
                @include('common.errors')

                <!-- New Task Form -->
                <form action="{{ url('task')  }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    <!-- postのtaskのurlに送信する -->
                    <!-- 波括弧で囲まれたデータは、phpのhtmlentities関数を通して表示される。HTMLエンティティ化 -->
                    <!--
                    CSRFからアプリケーションを守る。laravelは自動的にCFRFトークンを生成する。
                    実装にアプリケーションに対してリクエストを送信しているのかを確認するために利用 トークン隠しフィールドの生成
                     -->

                    <!-- Task Name  -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">Task</label>
                        <div class="col-sm-6">
                            <input type="text" name="name" id="task-name" class="form-control">
                        </div>
                    </div>

                    <!-- Add Task Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Current Tasks -->
        <!-- ０以上なら（タスクがなるなら） -->
        @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Tasks
            </div>
            <?php $i = 0; ?>
            @foreach($tasks as $task)
            @if($task->completed =='0')
            <?php $i++; ?>
            @endif
            @endforeach


            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                        <th>Task</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- 
                        thead : table header 行をグループ化
                        th : 見出しセル
                        &nbsp　：non-break-space 改行をしないスペース
                    -->
                    <tbody>
                        @foreach($tasks as $task)
                        <!-- taskの要素を表示 -->
                        <tr>

                            <td>
                                <form action="{{ url('task/'.$task->id) }}" method="POST">
                                    <!-- taskのidに対して 
                                    deleteのパスは'/task/{id}' 
                                    -->
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}
                                    <!-- httpメソッド　PATCH
                                    <input type="hidden" name="_method" value="PATCH" が生成
                                    -->
                                    <button type="submit" class="btn btn-done">
                                        <i class="fa fa-done"></i> Completed
                                    </button>
                                </form>
                            </td>

                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $task->name }}</div>
                            </td>

                            <!-- Delete Button -->
                            <td>
                                <form action="{{ url('task/'.$task->id) }}" method="POST">
                                    <!-- taskのidに対して 
                                    deleteのパスは'/task/{id}' 
                                    -->
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <!-- httpメソッド　DELETE	
                                    <input type="hidden" name="_method" value="DELETE" が生成
                                    -->
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <td>&nbsp;</td>

                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer>
                <div class=todo-count>
                    active:{{$i}}
                    <br>
                    {{ str_replace(url('/'),"",request()->fullUrl()) }}
                </div>
                <ul class="filters">
                    <li>
                        <a href="/?filter=all">All</a>
                    </li>
                    <li>
                        <a href="/?filter=active">Active</a>
                    </li>
                    <li>
                        <a href="/?filter=completed">Completed</a>
                    </li>
                </ul>

            </footer>
        </div>
        @endif

        <div class=" panel-body">
            <table class="table table-striped task-table">
                <thead>
                    <th>Completed</th>
                    <th>&nbsp;</th>
                </thead>
                <!-- 
                        thead : table header 行をグループ化
                        th : 見出しセル
                        &nbsp　：non-break-space 改行をしないスペース
                    -->
                <tbody>
                    @foreach($tasks as $task)
                    @if($task->completed =='1')
                    <!-- taskの要素を表示 -->
                    <tr>

                        <td>
                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                <!-- taskのidに対して 
                                    deleteのパスは'/task/{id}' 
                                    -->
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <!-- httpメソッド　PATCH
                                    <input type="hidden" name="_method" value="PATCH" が生成
                                    -->
                                <button type="submit" class="btn btn-done">
                                    <i class="fa fa-done"></i> Completed
                                </button>
                            </form>
                        </td>

                        <!-- Task Name -->
                        <td class="table-text">
                            <div>{{ $task->name }}</div>
                        </td>

                        <!-- Delete Button -->
                        <td>
                            <form action="{{ url('task/'.$task->id) }}" method="POST">
                                <!-- taskのidに対して 
                                    deleteのパスは'/task/{id}' 
                                    -->
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <!-- httpメソッド　DELETE	
                                    <input type="hidden" name="_method" value="DELETE" が生成
                                    -->
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    <td>&nbsp;</td>
                    <div>

                    </div>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection