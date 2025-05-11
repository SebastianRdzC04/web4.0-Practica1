@php
    // Utilizar los datos pasados como prop o usar valores por defecto
    $datos = $datos ?? [
        ['name' => 'Hombres', 'data' => 500, 'color' => '#3b82f6'],
        ['name' => 'Mujeres', 'data' => 354, 'color' => '#ffffff'],
    ];

    // Generar un ID único para cada instancia del gráfico
    $chartId = 'generoChart_' . uniqid();

    $tituloConvertido = $titulo ?? 'Default';
    $tituloJSON = json_encode($tituloConvertido);

    $datosJSON = json_encode($datos);
@endphp

<div class="p-4 flex flex-col items-center">
    <canvas id="{{ $chartId }}" width="400" height="300"></canvas>
    <div class="flex justify-center mt-4">
        @foreach($datos as $dato)
            <div class="flex items-center mr-4">
                <div class="w-4 h-4 mr-2 rounded-sm" style="background-color: {{$dato['color']}}"></div>
                <span class="text-gray-700">{{$dato["name"]}}: {{$dato["data"]}}</span>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('{{ $chartId }}');
        const ctx = canvas.getContext('2d');

        const datosPhp = {!! $datosJSON !!};
        const titulo = {!! $tituloJSON !!};

        // Adaptar al formato que usa tu código actual
        const datos = datosPhp.map(item => ({
            etiqueta: item.name,
            valor: item.data,
            color: item.color
        }));

        const anchoCanvas = canvas.width;
        const altoCanvas = canvas.height;
        const margen = 50;
        const areaGrafica = {
            x: margen,
            y: margen,
            ancho: anchoCanvas - margen * 2,
            alto: altoCanvas - margen * 2
        };

        const valorMaximo = Math.max(...datos.map(item => item.valor));
        const valorMaximoAjustado = Math.ceil(valorMaximo * 1.1); // Añadir 10% para mejor visualización
        const escalaY = areaGrafica.alto / valorMaximoAjustado;

        const anchoBarra = areaGrafica.ancho / (datos.length * 2);

        // Limpiar el canvas
        ctx.clearRect(0, 0, anchoCanvas, altoCanvas);

        // Dibujar fondo con gradiente suave
        const gradient = ctx.createLinearGradient(0, 0, 0, altoCanvas);
        gradient.addColorStop(0, 'rgba(249, 250, 251, 0.8)');
        gradient.addColorStop(1, 'rgba(249, 250, 251, 0.2)');
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, anchoCanvas, altoCanvas);

        // Dibujar ejes con estilo mejorado
        ctx.beginPath();
        ctx.moveTo(areaGrafica.x, areaGrafica.y);
        ctx.lineTo(areaGrafica.x, areaGrafica.y + areaGrafica.alto);
        ctx.lineTo(areaGrafica.x + areaGrafica.ancho, areaGrafica.y + areaGrafica.alto);
        ctx.strokeStyle = '#94a3b8';
        ctx.lineWidth = 2;
        ctx.stroke();
        ctx.lineWidth = 1;

        // Dibujar líneas horizontales y etiquetas del eje Y
        const numLineas = 5;
        ctx.textAlign = 'right';
        ctx.fillStyle = '#64748b';
        ctx.font = '12px Inter, sans-serif';

        for (let i = 0; i <= numLineas; i++) {
            const y = areaGrafica.y + areaGrafica.alto - (i * areaGrafica.alto / numLineas);
            const valor = Math.round(i * valorMaximoAjustado / numLineas);

            ctx.beginPath();
            ctx.moveTo(areaGrafica.x - 5, y);
            ctx.lineTo(areaGrafica.x + areaGrafica.ancho, y);
            ctx.strokeStyle = 'rgba(203, 213, 225, 0.7)';
            ctx.stroke();

            ctx.fillText(valor.toString(), areaGrafica.x - 10, y + 5);
        }

        datos.forEach((dato, i) => {
            const x = areaGrafica.x + (i * anchoBarra * 2) + anchoBarra / 2;
            const alturaBarra = dato.valor * escalaY;
            const y = areaGrafica.y + areaGrafica.alto - alturaBarra;

            // Crear gradiente para la barra
            const barGradient = ctx.createLinearGradient(x, y, x, y + alturaBarra);
            const baseColor = dato.color;
            const lighterColor = lightenColor(baseColor, 20);

            barGradient.addColorStop(0, baseColor);
            barGradient.addColorStop(1, lighterColor);

            // Dibujar barra redondeada
            roundedRect(ctx, x, y, anchoBarra, alturaBarra, 6, barGradient);

            // Dibujar valor dentro de la barra si hay espacio
            if (alturaBarra > 25) {
                ctx.fillStyle = 'white';
                ctx.font = 'bold 12px Inter, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(dato.valor.toString(), x + anchoBarra/2, y + alturaBarra/2 + 5);
            }

            // Etiqueta de la categoría
            ctx.fillStyle = '#334155';
            ctx.textAlign = 'center';
            ctx.font = '13px Inter, sans-serif';
            ctx.fillText(dato.etiqueta, x + anchoBarra / 2, areaGrafica.y + areaGrafica.alto + 20);
        });

        // Título del gráfico
        ctx.fillStyle = '#334155';
        ctx.textAlign = 'center';
        ctx.font = 'bold 16px Inter, sans-serif';
        ctx.fillText(titulo, anchoCanvas / 2, 20);

        // Función para dibujar rectángulos con bordes redondeados
        function roundedRect(ctx, x, y, width, height, radius, fillStyle) {
            if (height < 2*radius) radius = height/2;
            ctx.beginPath();
            ctx.moveTo(x + radius, y);
            ctx.lineTo(x + width - radius, y);
            ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
            ctx.lineTo(x + width, y + height - radius);
            ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
            ctx.lineTo(x + radius, y + height);
            ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
            ctx.lineTo(x, y + radius);
            ctx.quadraticCurveTo(x, y, x + radius, y);
            ctx.closePath();
            ctx.fillStyle = fillStyle;
            ctx.fill();

            // Borde sutil
            ctx.strokeStyle = 'rgba(148, 163, 184, 0.3)';
            ctx.stroke();
        }

        // Función para aclarar un color hex
        function lightenColor(hex, percent) {
            hex = hex.replace('#', '');
            const r = parseInt(hex.substr(0, 2), 16);
            const g = parseInt(hex.substr(2, 2), 16);
            const b = parseInt(hex.substr(4, 2), 16);

            const lightenR = Math.min(255, Math.floor(r + (255 - r) * (percent / 100)));
            const lightenG = Math.min(255, Math.floor(g + (255 - g) * (percent / 100)));
            const lightenB = Math.min(255, Math.floor(b + (255 - b) * (percent / 100)));

            return `rgb(${lightenR}, ${lightenG}, ${lightenB})`;
        }
    });
</script>

