@props(['campaign' => null])

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Основные настройки кампании</h5>
    </div>
    <div class="card-body">
        <div class="form-group mb-3">
            <label for="name">Название кампании</label>
            <input type="text" class="form-control @error('Name') is-invalid @enderror" 
                   id="name" name="name" value="{{ old('Name', $campaign?->name) }}" required>
            @error('Name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="status">Статус кампании</label>
            <select class="form-select @error('Status') is-invalid @enderror" 
                    id="status" name="status" required>
                <option value="active" {{ old('Status', $campaign?->status) == 'active' ? 'selected' : '' }}>Активна</option>
                <option value="paused" {{ old('Status', $campaign?->status) == 'paused' ? 'selected' : '' }}>На паузе</option>
                <option value="stopped" {{ old('Status', $campaign?->status) == 'stopped' ? 'selected' : '' }}>Остановлена</option>
            </select>
            @error('Status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="url">Рекламируемая страница</label>
            <input type="url" class="form-control @error('Url') is-invalid @enderror" 
                   id="url" name="url" value="{{ old('Url', $campaign?->url) }}" required>
            @error('Url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div> 