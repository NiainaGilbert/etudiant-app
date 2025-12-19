<div class="language-switcher">
    <form action="{{ route('language.change') }}" method="get" class="language-form">
        <select name="lang" onchange="this.form.submit()">
            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>
                🇫🇷 {{ __('French') }}
            </option>
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                🇬🇧 {{ __('English') }}
            </option>
        </select>
    </form>
</div>