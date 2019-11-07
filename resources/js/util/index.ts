export { default as confirm } from './confirm';

export function pluralize(subject: string, count: number): string {
    return subject + (count === 1 ? '' : 's');
}
