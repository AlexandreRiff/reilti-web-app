@props(['action', 'method', 'resource'])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data" novalidate class="p-3">
    @csrf()
    @method($method)

    <!-- TITULO -->
    <div class="mb-3">
        <label for="add__title" class="form-label add__label">Título *</label>
        <input type="text" name="title" required id="add__title"
            class="form-control fw-light @error('title') is-invalid @enderror"
            value="{{ old('title', $resource->title ?? '') }}" />

        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END TITULO -->

    <!-- AREA TECNOLOGICA -->
    <div class="mb-3">
        <div class="mb-3">
            <label for="add__tech-area" class="form-label add__label">Área tecnológica</label>
            <input type="text" name="techArea" id="add__tech-area"
                class="form-control fw-light @error('techArea') is-invalid @enderror"
                @if (old('techArea')) value="{{ old('techArea') }}"
                    @elseif (isset($resource->techAreas))
                        @foreach ($resource->techAreas as $techArea)
                            value="{{ $techArea->name }}"
                        @endforeach @endif />

            @error('techArea')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>
    </div>
    <!-- END AREA TECNOLOGICA -->

    <!-- CURSO -->
    <div class="mb-3">
        <label for="add__course" class="form-label add__label">Curso</label>
        <input type="text" name="course" id="add__course"
            class="form-control fw-light @error('course') is-invalid @enderror"
            @if (old('course')) value="{{ old('course') }}"
            @elseif (isset($resource->courses))
                @foreach ($resource->courses as $course)
                    value="{{ $course->name }}"
                @endforeach @endif />

        @error('course')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END CURSO -->

    <!-- DISCIPLINA -->
    <div class="mb-3">
        <label for="add__discipline" class="form-label add__label">Disciplina</label>
        <input type="text" name="discipline" id="add__discipline"
            class="form-control fw-light @error('discipline') is-invalid @enderror"
            @if (old('discipline')) value="{{ old('discipline') }}"
            @elseif (isset($resource->disciplines))
                @foreach ($resource->disciplines as $discipline)
                    value="{{ $discipline->name }}"
                @endforeach @endif />

        @error('discipline')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END DISCIPLINA -->

    <!-- IDIOMA -->
    <div class="mb-3">
        <label for="add__language" class="form-label add__label">Idioma</label>
        <select name="language" id="add__language" class="form-select fw-light @error('language') is-invalid @enderror">
            <option disabled>Selecione</option>

            @foreach ($languages as $language)
                <option value="{{ $language->id }}" @selected(old('language', $resource->language->id ?? '') == $language->id)>
                    {{ $language->name }}
                </option>
            @endforeach

        </select>

        @error('language')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END IDIOMA -->

    <!-- DESCRICAO -->
    <div class="mb-3">
        <label for="add__description" class="form-label add__label">Descrição</label>
        <textarea rows="6" name="description" id="add__description"
            class="form-control fw-light @error('description') is-invalid @enderror"> {{ old('description', $resource->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END DESCRICAO -->

    <!-- TIPO MIDIA -->
    <div class="mb-3">
        <label for="add__media" class="form-label add__label">Tipo de Recurso *</label>
        <select name="media" id="add__media" class="form-select fw-light @error('media') is-invalid @enderror"
            @disabled($resource->media ?? false) data-js="inputMedia">
            <option disabled>Selecione</option>

            @foreach ($medias as $media)
                <option value="{{ $media->id }}" @selected(isset($resource->media) ? $resource->media->id == $media->id : old('media') == $media->id)>
                    {{ $media->type }}
                </option>
            @endforeach

        </select>

        @error('media')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END TIPO MIDIA -->

    <!-- UPLOAD -->
    <div class="mb-3">
        <label for="add__file" class="form-label add__label">Upload *</label>
        <input type="file" accept=".zip, .pdf, audio/*" name="file" required id="add__file"
            class="form-control fw-light @error('file') is-invalid @enderror @error('fileInitial') is-invalid @enderror"
            data-js="inputFile" />

        @error('file')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

        @error('fileInitial')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END UPLOAD -->

    <!-- DIRECTORY TREE -->
    <div class="mb-3 d-none" data-js="sectionDirectoryTree">
        <p class="mb-2 add__label">Selecione o arquivo de inicialização *</p>
        <div class="p-3 border border-1 rounded-2 fs-09" data-js="directoryTree"></div>
        <input type="hidden" name="fileInitial" value="" data-js="inputFileInitial" />
    </div>
    <!-- END DIRECTORY TREE -->

    <!-- TAGS -->
    <div class="mb-3">
        <label for="add__tags" class="form-label add__label">Tags</label>
        <input type="text" name="tags" id="add__tags"
            class="form-control fw-light @error('tags') is-invalid @enderror"
            @if (old('tags')) value="{{ old('tags') }}"
            @elseif (isset($resource->tags))
                @foreach ($resource->tags as $tag)
                    value="{{ $tag->name }}"
                @endforeach @endif />

        @error('tags')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>
    <!-- END TAGS -->

    <!-- IMAGEM DE DESTAQUE -->
    <div class="mb-3">
        <label for="add__image" class="form-label add__label">Imagem de destaque</label>
        <label for="add__image" class="d-block p-5 rounded-2 add-image__box @error('image') is-invalid @enderror"
            style="@error('image') border-color: var(--bs-form-invalid-border-color) @enderror"
            data-js="boxImageDragAndDrop">
            <input type="file" accept="image/*" name="image" id="add__image" class="d-none"
                data-js="inputAddImage" />
            <img src="{{ isset($resource->thumbnail) ? Storage::url($resource->thumbnail) : '' }}"
                alt="Imagem selecionada"data-js="imgPreview"
                class="img-fluid mx-auto add-image__preview
                    @isset($resource->thumbnail)
                        d-block
                    @endisset" />

            <p data-js="boxViewImageInner"
                class="d-flex flex-column align-items-center justify-content-center m-0 fs-095
                    @isset($resource->thumbnail)
                        d-none
                    @endisset">

                <i class="bi bi-image fs-1 add-image__icon"></i>
                Arraste sua imagem ou
                <span class="text-primary text-decoration-underline add-image__click-text">
                    clique aqui
                </span>
            </p>
        </label>

        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <!-- EMD IMAGEM DE DESTAQUE -->

    <!-- VISIBILIDADE -->
    <p class="form-label add__label">Visibilidade</p>
    <div class="form-check form-check-inline">
        <input type="radio" name="visibility" value="public" id="add-visibility__public" class="form-check-input"
            @checked(old('visibility', $resource->visibility ?? '') == 'public') />
        <label class="form-check-label fw-light" for="add-visibility__public">Público</label>
    </div>

    <div class="form-check form-check-inline mb-3">
        <input type="radio" name="visibility" value="private" id="add-visibility__private"
            class="form-check-input" @checked(old('visibility', $resource->visibility ?? true) == 'private') />
        <label class="form-check-label fw-light" for="add-visibility__private">Privado</label>
    </div>
    <!-- END VISIBILIDADE -->

    <!-- BOTOES -->
    <div class="d-flex justify-content-between gap-4 mt-4 mt-sm-5 add__buttons">
        <a href="{{ route('resource.index') }}"
            class="btn btn-primary px-3 py-2 rounded-1 text-capitalize fw-medium fs-095">
            <i class="bi bi-x-lg me-1"></i>
            Cancelar
        </a>
        <button type="submit" class="btn btn-primary px-3 py-2 rounded-1 text-capitalize fw-medium fs-095">
            <i class="bi bi-save me-1"></i>
            Salvar
        </button>
    </div>
    <!-- END BOTOES -->
</form>
