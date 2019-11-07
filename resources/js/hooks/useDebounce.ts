import { debounce } from 'lodash';
import { useCallback } from 'react';

export default function useDebounce<T extends (...args: Array<any>) => any>(callback: T, deps: Array<any>): T {
    return useCallback(debounce(callback, 250), deps);
}
