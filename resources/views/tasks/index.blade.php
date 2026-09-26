<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            color: #111;
        }

        /* HEADER */
        header {
            background: #111;
            color: white;
            padding: 25px 50px;
        }

        header h1 {
            margin: 0;
            font-size: 28px;
        }

        header p {
            margin: 6px 0 0;
            color: #ccc;
        }

        /* MAIN CONTAINER */
        .container {
            width: 92%;
            max-width: 1200px;
            margin: 35px auto;
        }

        /* TITLE AREA */
        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top-section h2 {
            margin: 0;
            font-size: 25px;
            color: #111;
        }

        /* ADD BUTTON */
        .add-button {
            background: #111;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-button:hover {
            background: #333;
        }

        /* SUMMARY CARDS */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .card-number {
            font-size: 30px;
            font-weight: bold;
            color: #111;
        }

        /* SUCCESS MESSAGE */
        .success {
            background: #eeeeee;
            border-left: 5px solid #111;
            color: #111;
            padding: 14px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        /* TABLE CONTAINER */
        .table-container {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #111;
            color: white;
            padding: 16px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #e5e5e5;
            color: #333;
        }

        tbody tr:hover {
            background: #fafafa;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* STATUS */
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #eeeeee;
            color: #222;
        }

        .completed {
            background: #111;
            color: white;
        }

        /* ACTIONS */
        .actions {
            display: flex;
            gap: 6px;
            align-items: center;
            flex-wrap: wrap;
        }

        .actions form {
            display: inline;
            margin: 0;
        }

        .edit-button,
        .complete-button,
        .delete-button {
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        /* EDIT */
        .edit-button {
            background: #222;
            color: white;
        }

        .edit-button:hover {
            background: #444;
        }

        /* COMPLETE */
        .complete-button {
            background: #111;
            color: white;
            border: none;
        }

        .complete-button:hover {
            background: #333;
        }

        /* DELETE */
        .delete-button {
            background: #333;
            color: white;
            border: none;
        }

        .delete-button:hover {
            background: #000;
        }

        /* EMPTY */
        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 10px;
            color: #777;
        }

        /* MOBILE */
        @media (max-width: 800px) {

            .summary {
                grid-template-columns: 1fr;
            }

            .top-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            header {
                padding: 22px;
            }

            .container {
                width: 94%;
            }

            th,
            td {
                padding: 12px;
            }
        }
    </style>
</head>

<body>

<header>
    <h1>Personal Task Manager</h1>
    <p>Manage your tasks easily and stay organized.</p>
</header>


<div class="container">

    {{-- SUCCESS MESSAGE --}}
    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif


    {{-- TITLE AND ADD BUTTON --}}
    <div class="top-section">

        <div>
            <h2>My Tasks</h2>
        </div>

        <a href="/tasks/create" class="add-button">
            + Add New Task
        </a>

    </div>


    {{-- SUMMARY CARDS --}}
    <div class="summary">

        <div class="card">
            <div class="card-title">
                Total Tasks
            </div>

            <div class="card-number">
                {{ $tasks->count() }}
            </div>
        </div>


        <div class="card">
            <div class="card-title">
                Pending
            </div>

            <div class="card-number">
                {{ $tasks->where('status', 'Pending')->count() }}
            </div>
        </div>


        <div class="card">
            <div class="card-title">
                Completed
            </div>

            <div class="card-number">
                {{ $tasks->where('status', 'Completed')->count() }}
            </div>
        </div>

    </div>


    {{-- TASKS --}}
    @if($tasks->count() > 0)

        <div class="table-container">

            <table>

                <thead>

                    <tr>
                        <th>Task</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>

                </thead>


                <tbody>

                    @foreach($tasks as $task)

                        <tr>

                            {{-- TASK NAME --}}
                            <td>
                                <strong>
                                    {{ $task->task_name }}
                                </strong>
                            </td>


                            {{-- DESCRIPTION --}}
                            <td>
                                {{ $task->description }}
                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($task->status === 'Pending')

                                    <span class="status pending">
                                        Pending
                                    </span>

                                @else

                                    <span class="status completed">
                                        Completed
                                    </span>

                                @endif

                            </td>


                            {{-- DUE DATE --}}
                            <td>
                                {{ $task->due_date }}
                            </td>


                            {{-- ACTIONS --}}
                            <td>

                                <div class="actions">

                                    {{-- EDIT --}}
                                    <a
                                        href="/tasks/{{ $task->id }}/edit"
                                        class="edit-button"
                                    >
                                        Edit
                                    </a>


                                    {{-- COMPLETE / SET PENDING --}}
                                    <form
                                        action="/tasks/{{ $task->id }}/status"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="complete-button"
                                        >
                                            {{ $task->status === 'Pending' ? 'Complete' : 'Set Pending' }}
                                        </button>

                                    </form>


                                    {{-- DELETE --}}
                                    <form
                                        action="/tasks/{{ $task->id }}"
                                        method="POST"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="delete-button"
                                            onclick="return confirm('Are you sure you want to delete this task?')"
                                        >
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    @else

        <div class="empty">

            <h3>No Tasks Yet</h3>

            <p>
                Click "Add New Task" to create your first task.
            </p>

        </div>

    @endif

</div>

</body>
</html>