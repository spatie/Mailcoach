import React, { useState, useLayoutEffect, useRef } from 'react';
import DatePicker, { registerLocale } from 'react-datepicker';
import { enGB } from 'date-fns/locale';
import Field from './Field';
import { format } from 'date-fns';

registerLocale('en-GB', enGB);

type Props = {
    name: string;
    label?: string;
    error?: string;
    value: Date | string | null;
    required?: boolean;
    onChange: (value: Date | string | null) => void;
};

export default function DateField({ name, label, error, value, onChange, required }: Props) {
    const [date, setDate] = useState(value ? new Date(value) : null);
    const datePickerRef = useRef<DatePicker | null>(null);

    useLayoutEffect(() => {
        setDate(value ? new Date(value) : null);
    }, [value]);

    function handleChange(newDate: Date | null) {
        onChange(newDate ? format(newDate, 'yyyy-MM-dd HH:mm:00') : null);
        setDate(newDate);
    }

    function stopEnterKeyPropagation(event: React.KeyboardEvent) {
        if (event.key === 'Enter') {
            event.preventDefault();

            if (datePickerRef.current) {
                datePickerRef.current.setOpen(false);
            }
        }
    }

    return (
        <Field
            label={label}
            name={name}
            required={required}
            error={error}
            onKeyUp={stopEnterKeyPropagation}
            onKeyPress={stopEnterKeyPropagation}
        >
            <DatePicker
                ref={datePickerRef}
                locale="en-GB"
                selected={date}
                onChange={handleChange}
                inline
                showTimeSelect
                timeFormat="HH:mm"
                timeIntervals={10}
                timeCaption="time"
                isClearable={true}
            />
        </Field>
    );
}
