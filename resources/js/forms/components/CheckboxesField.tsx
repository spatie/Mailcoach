import React, { useState } from 'react';
import { CheckboxField } from 'forms';

type Props = {
    name: string;
    options: Array<{ value: number; label: string }>;
    value?: Array<number>;
    onChange: (value: Array<number>) => void;
};

export default function CheckboxesField({ name, options = [], value, onChange }: Props) {
    const [checkBoxValues, setCheckboxValues] = useState(value || []);

    function handleInput(checked: boolean, value: number) {
        const updatedCheckBoxValues = checked ? [...checkBoxValues, value] : checkBoxValues.filter(o => o !== value);

        setCheckboxValues(updatedCheckBoxValues);

        onChange(updatedCheckBoxValues);
    }

    return (
        <div className="checkbox-group">
            {options.map(option => (
                <CheckboxField
                    key={option.value}
                    name={`${name}[]`}
                    value={checkBoxValues.includes(option.value)}
                    onChange={checked => handleInput(checked, option.value)}
                    label={option.label}
                />
            ))}

            {!checkBoxValues.length && <input type="hidden" name={`${name}[]`} value="" />}
        </div>
    );
}
