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
    :value="$editorConfiguration->font_family"
/>

<x-text-field
    label="Font size"
    name="monaco_font_size"
    :value="$editorConfiguration->font_size"
    type="number"
/>

<x-text-field
    label="Line height"
    name="monaco_line_height"
    :value="$editorConfiguration->line_height"
    type="number"
/>
