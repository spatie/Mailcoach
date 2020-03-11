[Monaco](https://microsoft.github.io/monaco-editor/) is a powerful code editor created by Microsoft. It provides code highlighting, auto completion and much more.


<x-select-field
    label="Editor"
    name="monaco_theme"
    :value="$editorConfiguration->theme"
    :options="['vs-light', 'vs-dark']"
/>
