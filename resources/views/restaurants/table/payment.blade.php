@extends('layouts.restaurant-app')

@section('content')
<div class="w-fit">
    <div>
        <h2 class="font-bold text-2xl">Tafel: {{$table->id}}</h2>
    </div>
    <div id="print" class="w-[321px]">
        <table class=" bg-white">

            <tbody>
                @foreach($orderdProducts as $product)
                <tr class="border-b">
                    <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                    <td class="py-3 px-6 text-left">€{{ $product->price }}</td>
                </tr>
                @endforeach
                @foreach($orderdProducts as $product)
                <tr class="border-b">
                    <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                    <td class="py-3 px-6 text-left">€{{ $product->price }}</td>
                </tr>
                @endforeach
                @foreach($orderdProducts as $product)
                <tr class="border-b">
                    <td class="py-3 px-6 text-left">{{ $product->name }}</td>
                    <td class="py-3 px-6 text-left">{{ $product->quantity }}</td>
                    <td class="py-3 px-6 text-left">€{{ $product->price }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
        <p class="text-right pb-10 mr-16">€{{ $table->tableOrder->order->products->sum('price') }}</p>
    </div>
    <div class=" flex gap-5">
        <a href="{{ route('table.pay', $table) }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
            Afrekenen
        </a>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
            onclick="handleDownloadPDF()">PDF</button>
    </div>
</div>

@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
    integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const { jsPDF } = window.jspdf;
    const handleDownloadPDF = () => {
        console.log('download pdf')
        const domElement = document.getElementById('print');
        if (domElement) {
            html2canvas(domElement, { scale: 2, useCORS: true }).then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdfWidth = 100; // 10 cm
                const pdfHeight = 85; // 8.5 cm
                const imgWidth = canvas.width * pdfWidth / canvas.width; // scale image width to match pdf width
                const imgHeight = canvas.height * pdfHeight / canvas.width; // scale image height based on the scaled width
                const numPages = Math.ceil(imgHeight / pdfHeight);

                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: [pdfWidth, pdfHeight]
                });

                for (let i = 0; i < numPages; i++) {
                    const srcY = i * pdfHeight;
                    pdf.addImage(imgData, 'PNG', 0, -srcY, imgWidth, imgHeight);
                    if (i < numPages - 1) {
                        pdf.addPage();
                    }
                }
                pdf.save(`Rekening.pdf`);
            });
        }
    };
</script>