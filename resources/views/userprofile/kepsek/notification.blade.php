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
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Nama Penanggung Jawab: {{ $item->data["user_pj"] }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Kegiatan: {{ $item->data['nama_kegiatan'] }}</div>
                            <div class="h6 mb-0 font-weight-bold mt-1 mb-1">Status: {{ $item->data["status_kegiatan"] }}</div>
                            <div class="small text-gray-500 mt-1">{{ $item->created_at }}</div>
                          </div>
                          @if ($item['read_at'] === null)
                          <div class="col-auto">
                            <a href="#" class="mr-2 notificationRead" id="{{ $item->id }}">
                                <i class="fa fa-check fa-2x"></i>
                            </a>
                            <a href="{{ $item->data['link'] }}" class="notificationLink" id="{{ $item->id }}">
                                <i class="fa fa-arrow-right fa-2x"></i>
                            </a>
                          </div>
                          @else
                          <div class="col-auto">
                            {{-- <a href="#"> --}}
                            <a href="javascript:void(0)" class="mr-2" style="pointer-events: none;">
                                <i class="fa fa-thumbs-up fa-2x text-gray-500"></i>
                            </a>
                            <a href="{{ $item->data['link'] }}" class="notificationLink" id="alreadyRead">
                                <i class="fa fa-arrow-right fa-2x"></i>
                            </a>
                            {{-- </a> --}}
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
        