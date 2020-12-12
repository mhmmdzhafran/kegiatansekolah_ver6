<div id="notification_box">
    <table class="table table-borderless">
      @if (count($notification) === 0)
          <tbody>
            <td class="text-center">
              Tidak Terdapat Notifikasi
            </td>
          </tbody>
        @else
        @foreach ($notification as $item)
        <tbody class="">
            <td>
              @if ($item->data['type_notification'] == 'Proposal Kegiatan')
                <div class="card border-left-success shadow h-100 py-2">  
              @elseif($item->data['type_notification'] == 'Laporan Kegiatan')
                <div class="card border-left-info shadow h-100 py-2">  
              @endif
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nama Penanggung Jawab: {{ $item->data["user_pj"] }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Nama Kegiatan: {{ $item->data['nama_kegiatan'] }}</div>
                            <div class="h6 mb-0 font-weight-bold mt-1 mb-1">Status Kegiatan: {{ $item->data["status_kegiatan"] }}</div>
                            <div class="h6 mb-0 font-weight-bold mt-1 mb-1">Nilai: {{ $item->data["nilai_ppk"] }}</div>
                            <div class="h6 mb-0 font-weight-bold mt-1 mb-1">Kegiatan Berbasis: {{ $item->data["kegiatan_berbasis"] }}</div>
                            <div class="h6 mb-0 font-weight-bold mt-1 mb-1">
                              Tipe Kegiatan:
                              @if ($item->data['type_notification'] != "")
                                @if ($item->data['type_notification'] == 'Laporan Kegiatan')
                                    @if ($item->data['tipe_pengajuan'] == 'Pengajuan Historis')
                                    {{ $item->data['type_notification'] }} (Historis)
                                    @elseif($item->data['tipe_pengajuan'] == 'Pengajuan')
                                      ({{ $item->data['tipe_pengajuan'] }})
                                    @else
                                      N/A
                                    @endif
                                @elseif($item->data['type_notification'] == 'Proposal Kegiatan')
                                  {{ $item->data['type_notification'] }}    
                                @else
                                N/A  
                                @endif
                              @else
                              N/A
                              @endif
                            </div>
                            <div class="small text-gray-500 mt-1">{{ $item->created_at->timezone('Asia/Jakarta') }}</div>
                          </div>
                          @if ($item['read_at'] === null)
                          <div class="col-auto">
                            <a href="#" class="mr-2 notificationRead" id="{{ $item->id }}">
                                <i class="fa fa-check fa-2x"></i>
                            </a>
                            <a href="#" class="notificationLink" id="{{ $item->id }}" data-type="{{ $item->data['type_notification'] }}">
                                <i class="fa fa-arrow-right fa-2x"></i>
                            </a>
                          </div>
                          @else
                          <div class="col-auto">
                            <a href="javascript:void(0)" class="mr-2" style="pointer-events: none;">
                                <i class="fa fa-thumbs-up fa-2x text-gray-500"></i>
                            </a>
                            <a href="#" class="notificationLink" id="alreadyRead" data-id="{{ $item->id }}" data-type="{{ $item->data['type_notification'] }}">
                                <i class="fa fa-arrow-right fa-2x"></i>
                            </a>
                          </div>
                          @endif
                        </div>
                    </div>
                </div>
            </td>
        </tbody>
        @endforeach
    </table>
    <div class="row justify-content-center page-renderer">
        {{ $notification->render() }}
    </div>
</div>
@endif
        