[Monaco](https://microsoft.github.io/monaco-editor/) is a powerful code editor created by Microsoft. It provides code highlighting, auto completion and much more.

<x-select-field
    label="Editor"
    name="monaco_theme"
    :value="$editorConfiguration->theme"
    :options="['vs-light', 'vs-dark']"
/>

<x-text-field
    label="Font family"
    name="monaco_font_family"
    :value="$editorConfiguration->monaco_font_family"
/>

<x-text-field
    label="Font size"
    name="monaco_font_size"
    :value="$editorConfiguration->monaco_font_size ?? 14"
    type="number"
/>

<x-text-field
    label="Font size"
    name="monaco_font_weight"
    :value="$editorConfiguration->monaco_font_weight ?? 400"
    type="number"
/>

<x-text-field
    label="Line height"
    name="monaco_line_height"
    :value="$editorConfiguration->monaco_line_height ?? 12"
    type="number"
/>
