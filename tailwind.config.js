module.exports = {
    important: false,
    theme: {
        customForms: theme => ({
            default: {
                input: {
                    '&:focus': {
                        boxShadow: 'none',
                        borderColor: theme('colors.blue.400'),
                    },
                },
                textarea: {
                    '&:focus': {
                        boxShadow: 'none',
                        borderColor: theme('colors.blue.400'),
                    },
                },
                select: {
                    '&:focus': {
                        boxShadow: 'none',
                        borderColor: theme('colors.blue.400'),
                    },
                },
                radio: {
                    '&:focus': {
                        boxShadow: 'none',
                    },
                },
                checkbox: {
                    '&:focus': {
                        boxShadow: 'none',
                    },
                },
            },
        }),
    },
    variants: {
        color: ['responsive', 'hover', 'focus'],
        opacity: ['responsive', 'hover', 'focus', 'group-hover'],
    },
    plugins: [require('@tailwindcss/custom-forms')],
};
