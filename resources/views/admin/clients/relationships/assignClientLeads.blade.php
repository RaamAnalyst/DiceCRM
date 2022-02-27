<div class="m-3">
    @can('lead_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.leads.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.lead.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.lead.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-assignClientLeads">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.lead_title') }}
                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.assign_user') }}
                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.deadline') }}
                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.qualified') }}
                            </th>
                            <th>
                                {{ trans('cruds.lead.fields.leads_doc') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $key => $lead)
                            <tr data-entry-id="{{ $lead->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $lead->id ?? '' }}
                                </td>
                                <td>
                                    {{ $lead->lead_title ?? '' }}
                                </td>
                                <td>
                                    {{ $lead->assign_user->name ?? '' }}
                                </td>
                                <td>
                                    {{ $lead->deadline ?? '' }}
                                </td>
                                <td>
                                    {{ $lead->status->status ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Lead::QUALIFIED_RADIO[$lead->qualified] ?? '' }}
                                </td>
                                <td>
                                    @foreach($lead->leads_doc as $key => $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">
                                            {{ trans('global.view_file') }}
                                        </a>
                                    @endforeach
                                </td>
                                <td>
                                    @can('lead_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.leads.show', $lead->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('lead_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.leads.edit', $lead->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('lead_delete')
                                        <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('lead_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.leads.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'asc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-assignClientLeads:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection