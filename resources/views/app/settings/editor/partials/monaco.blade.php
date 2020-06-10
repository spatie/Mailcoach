<x-help>
    {!! __('<a href=":link">Monaco</a> is a powerful code editor created by Microsoft. It provides code highlighting, auto completion and much more.', ['link' => 'https://microsoft.github.io/monaco-editor/']) !!}
</x-help>

<x-select-field
    :label="__('Editor')"
    name="monaco_theme"
    :value="$editorConfiguration->monaco_theme"
    :options="['vs-light' => 'vs-light', 'vs-dark' => 'vs-dark']"
/>

<x-text-field
    :label="__('Font family')"
    name="monaco_font_family"
    :value="$editorConfiguration->monaco_font_family ?? 'Courier New, Courier, monospace'"
/>

<x-text-field
    :label="__('Font size')"
    name="monaco_font_size"
    :value="$editorConfiguration->monaco_font_size ?? 16"
    type="number"
/>

<x-text-field
    :label="__('Font weight')"
    name="monaco_font_weight"
    :value="$editorConfiguration->monaco_font_weight ?? 400"
    type="number"
/>

<x-text-field
    :label="__('Line height')"
    name="monaco_line_height"
    :value="$editorConfiguration->monaco_line_height ?? 18"
    type="number"
/>
