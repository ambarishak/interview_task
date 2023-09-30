<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beautiful Bootstrap Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">{{ $forms->title }}</h3>
                    </div>
                    <div class="card-body">
                        <form>
                            @foreach ($forms->formControls as $element)
                                <div class="form-group">
                                    <label for="{{ $element->name }}">{{ $element->label }}</label>
                                    @if ($element->type == 'text')
                                        <input type="text" class="form-control" id="{{ $element->name }}"
                                            name="{{ $element->name }}">
                                    @elseif ($element->type == 'email')
                                        <input type="email" class="form-control" id="{{ $element->name }}"
                                            name="{{ $element->name }}">
                                    @elseif ($element->type == 'number')
                                        <input type="number" class="form-control" id="{{ $element->name }}"
                                            name="{{ $element->name }}">
                                    @elseif ($element->type == 'textarea')
                                        <textarea class="form-control" id="{{ $element->name }}" name="{{ $element->name }}" rows="4"></textarea>
                                    @elseif ($element->type == 'select')
                                        <select class="form-control" id="{{ $element->name }}"
                                            name="{{ $element->name }}">
                                            @foreach (explode(',', $element->options) as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                            @endforeach
                                        </select>
                                    @elseif ($element->type == 'checkbox')
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="{{ $element->name }}"
                                                name="{{ $element->name }}">
                                            <label class="form-check-label"
                                                for="{{ $element->name }}">{{ $element->label }}</label>
                                        </div>
                                    @elseif ($element->type == 'radio')
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="{{ $element->name }}"
                                                name="{{ $element->name }}" value="{{ $element->label }}">
                                            <label class="form-check-label"
                                                for="{{ $element->name }}">{{ $element->label }}</label>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
