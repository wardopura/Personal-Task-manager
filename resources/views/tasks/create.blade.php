<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add New Task</title>

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

        .container {
            width: 92%;
            max-width: 650px;
            margin: 40px auto;
        }

        .form-card {
            background: white;
            padding: 35px;
            border-radius: 10px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #111;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        textarea {
            height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #111;
        }

        .add-button {
            margin-top: 25px;
            background: #111;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #333;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #111;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .error {
            background: #f1f1f1;
            border-left: 5px solid #111;
            color: #111;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

    </style>

</head>


<body>

<header>

    <h1>Personal Task Manager</h1>

    <p>Add a new task</p>

</header>


<div class="container">

    <div class="form-card">

        <h2>Add New Task</h2>


        @if($errors->any())

            <div class="error">

                <strong>Please fix the following:</strong>

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="/tasks" method="POST">

            @csrf


            <label for="task_name">
                Task Name
            </label>

            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ old('task_name') }}"
                required
            >


            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
            >{{ old('description') }}</textarea>


            <label for="status">
                Status
            </label>

            <select
                id="status"
                name="status"
                required
            >

                <option
                    value="Pending"
                    {{ old('status') == 'Pending' ? 'selected' : '' }}
                >
                    Pending
                </option>

                <option
                    value="Completed"
                    {{ old('status') == 'Completed' ? 'selected' : '' }}
                >
                    Completed
                </option>

            </select>


            <label for="due_date">
                Due Date
            </label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ old('due_date') }}"
            >


            <button
                type="submit"
                class="add-button"
            >
                Add Task
            </button>

        </form>


        <a href="/" class="back-link">
            ← Back to Tasks
        </a>

    </div>

</div>

</body>

</html>