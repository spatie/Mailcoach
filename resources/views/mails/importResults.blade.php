Your import has been processed. {{ $subscriberImport->imported_subscribers_count }} {{ \Illuminate\Support\Str::plural($subscriberImport->imported_subscribers_count, 'subscriber') }} have been subscribed to the {{ $subscriberImport->emailList->name }} list. There were {{ $subscriberImport->error_count }} {{ \Illuminate\Support\Str::plural($subscriberImport->error_count, 'error') }}

@if($subscriberImport->error_count)
- [Error Report]($subscriberImport->getErrorReportUrl())
@endif
- [Imported subscribers]($subscriberImport->getImportedUsersReportUrl())
- [Original import upload]($subscriberImport->getImportFileUrl())
