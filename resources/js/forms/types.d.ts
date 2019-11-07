namespace Forms {
    type Form<T extends object> = {
        values: T;
        setValues: React.Dispatch<React.SetStateAction<T>>;
        reset: () => void;
        submit: Promise;
        getInputProps: (
            fieldName: string
        ) => {
            name: string;
            value: any;
            error: string;
            onChange: (value: any) => void;
        };
    };

    type Option = {
        label: string | JSX.Element;
        value: string;
    };

    type MultipleSelectOption = {
        label: string | JSX.Element;
        value: null | string;
    };

    namespace FormBuilder {
        type Fields = Array<FieldConfig>;

        type FieldConfigProperties = {
            name: string;
            label: string;
            icon?: string;
            show?: boolean;
            disabled?: boolean;
            required?: boolean;
            vertical?: boolean;
        };

        type FieldConfig =
            | (FieldConfigProperties & { type: 'text' })
            | (FieldConfigProperties & { type: 'boolean' })
            | (FieldConfigProperties & { type: 'date'; withTime?: boolean })
            | (FieldConfigProperties & { type: 'image' })
            | (FieldConfigProperties & { type: 'integer' })
            | (FieldConfigProperties & { type: 'location' })
            | (FieldConfigProperties & { type: 'money' })
            | (FieldConfigProperties & { type: 'range'; min: number; max: number; isMoney?: boolean })
            | (FieldConfigProperties & { type: 'section'; fields: Fields })
            | (FieldConfigProperties & { type: 'select'; multiple?: boolean; options: Array<Forms.Option> })
            | (FieldConfigProperties & { type: 'string' });
    }
}
