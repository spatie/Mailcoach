import React from 'react';
import { TextField } from 'forms';
import { Controlled as CodeMirror } from 'react-codemirror2';

type Props = {
    form: Forms.Form<App.TemplateResource>;
};

export default function TemplateFormFields({ form }: Props) {
    function handleChange(html: string) {
        form.getInputProps('html').onChange(html);
    }

    return (
        <>
            <TextField label="Name" {...form.getInputProps('name')} />

            <div className="form-textarea max-w-full overflow-x-auto p-0">
                <CodeMirror
                    value={form.getInputProps('html').value}
                    options={{
                        mode: 'xml',
                        indentUnit: 4,
                    }}
                    onBeforeChange={(_editor, _data, value) => handleChange(value)}
                />
            </div>
        </>
    );
}
