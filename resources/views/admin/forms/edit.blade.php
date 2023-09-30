@extends('layouts.admin')

@section('content')
    <div class="col-md-9">
        <h1 class="mb-4">Edit Form</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('admin.forms.update', $form->id) }}" method="POST" onsubmit="return validateForm()">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $form->title) }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $form->description) }}</textarea>
            </div>

            <h2>Form Elements</h2>



            @foreach ($form->formControls as $i => $customElement)
                <div class="custom-element">
                    <label for="label_{{ $i }}">Label</label>
                    <input type="text" name="custom_elements[{{$i}}][label]" id="label_{{ $i }}" value="{{$customElement->label}}" class="form-control mb-2" required>

                    <label for="type_{{ $i }}">Type</label>
                    <input type="text" name="custom_elements[{{$i}}][type]" id="type_{{ $i }}" value="{{$customElement->type}}" readonly>

                    @if ($customElement->type !== 'text' && $customElement->type !== 'textarea')
                        <label for="options_{{ $i }}">Options (Comma separated)</label>
                        <input type="text" name="custom_elements[{{$i}}][options]" id="options_{{ $i }}" value="{{$customElement->options}}" class="form-control mb-2">
                    @else
                        <input type="hidden" name="custom_elements[{{$i}}][options]" id="options_{{ $i }}" value="{{$customElement->options}}" class="form-control mb-2 options-hidden" style="display: none;">
                    @endif
                    <button type="button" class="btn btn-danger" onclick="removeCustomElement(this)">Delete</button>
                </div>
            @endforeach



            <div id="custom_elements_container"></div>

            <div class="form-group">
                <label for="custom_element">Add Custom Element</label>
                <select name="custom_element" id="custom_element" class="form-control">
                    <option value="">Select a Form Element</option>
                    <option value="text">Text Input</option>
                    <option value="textarea">Textarea</option>
                    <option value="select">Select</option>
                    <option value="radio">Radio Button</option>
                    <option value="checkbox">Checkbox</option>
                </select>
            </div>

            <input type="hidden" id="custom_elements_data" name="custom_elements_data" value="">

            <button type="button" id="add_custom_element" class="btn btn-primary mb-2">Add Element</button>

            <button type="submit" class="btn btn-primary">Update Form</button>
        </form>
    </div>

    <style>
        .custom-element {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .custom-element label {
            font-weight: bold;
        }

        .custom-element input[type="text"],
        .custom-element textarea,
        .custom-element select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .custom-element select {
            height: 34px;
        }

        .custom-element button {
            margin-top: 10px;
        }

        .error-text {
            color: red;
        }
    </style>

    <script>
        function validateForm() {
            const labelInputs = document.querySelectorAll("input[name^='custom_elements'][name$='[label]']");
            for (const input of labelInputs) {
                if (input.value.trim() === "") {
                    alert("Label fields cannot be empty.");
                    return false;
                }
            }
            return true;
        }

        function removeCustomElement(button) {
            const customElement = button.parentNode;
            customElement.parentNode.removeChild(customElement);
        }

        function toggleOptionsField() {
            const customElementSelect = document.getElementById("custom_element");
            const optionsFields = document.querySelectorAll(".options-hidden");
            if (customElementSelect.value === "text" || customElementSelect.value === "textarea") {
                for (const field of optionsFields) {
                    field.style.display = "none";
                }
            } else {
                for (const field of optionsFields) {
                    field.style.display = "block";
                }
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const customElementSelect = document.getElementById("custom_element");
            customElementSelect.addEventListener("change", toggleOptionsField);
            toggleOptionsField();

            const customElementsContainer = document.getElementById("custom_elements_container");
            const addCustomElementButton = document.getElementById("add_custom_element");
            const customElementsDataInput = document.getElementById("custom_elements_data");
            let elementIndex = {{$form->formControls->count()}};

            addCustomElementButton.addEventListener("click", function() {
                const selectedElement = customElementSelect.value;
                if (selectedElement) {
                    const elementDiv = document.createElement("div");
                    elementDiv.className = "custom-element";

                    const label = document.createElement("label");
                    label.textContent = "Label";
                    elementDiv.appendChild(label);
                    const elementLabelInput = document.createElement("input");
                    elementLabelInput.type = "text";
                    elementLabelInput.name =
                        `custom_elements[${elementIndex}][label]`;
                    elementLabelInput.className = "form-control mb-2";
                    elementLabelInput.required = true;
                    elementDiv.appendChild(elementLabelInput);

                    const typeLabel = document.createElement("label");
                    typeLabel.textContent = "Type";
                    elementDiv.appendChild(typeLabel);
                    const elementTypeInput = document.createElement("input");
                    elementTypeInput.type = "text";
                    elementTypeInput.name =
                        `custom_elements[${elementIndex}][type]`;
                    elementTypeInput.id = `type_${elementIndex}`;
                    elementTypeInput.value = selectedElement;
                    elementTypeInput.readOnly = true;
                    elementDiv.appendChild(elementTypeInput);

                    if (selectedElement !== 'text' && selectedElement !== 'textarea') {
                        const optionsLabel = document.createElement("label");
                        optionsLabel.textContent = "Options (Comma separated)";
                        elementDiv.appendChild(optionsLabel);
                        const elementOptionsInput = document.createElement("input");
                        elementOptionsInput.type = "text";
                        elementOptionsInput.name =
                            `custom_elements[${elementIndex}][options]`;
                        elementOptionsInput.id = `options_${elementIndex}`;
                        elementOptionsInput.className = "form-control mb-2";
                        elementDiv.appendChild(elementOptionsInput);
                    } else {
                        const optionsInput = document.createElement("input");
                        optionsInput.type = "text";
                        optionsInput.name =
                            `custom_elements[${elementIndex}][options]`;
                        optionsInput.id = `options_${elementIndex}`;
                        optionsInput.value = "";
                        optionsInput.className = "form-control mb-2 options-hidden";
                        optionsInput.style.display = "none";
                        elementDiv.appendChild(optionsInput);
                    }

                    const deleteButton = document.createElement("button");
                    deleteButton.type = "button";
                    deleteButton.className = "btn btn-danger";
                    deleteButton.textContent = "Delete";
                    deleteButton.addEventListener("click", function() {
                        removeCustomElement(deleteButton);
                    });
                    elementDiv.appendChild(deleteButton);
                    customElementsContainer.appendChild(elementDiv);
                    elementIndex++;
                    customElementsDataInput.value =
                        "custom_elements_data";
                }
            });
        });
    </script>
@endsection
