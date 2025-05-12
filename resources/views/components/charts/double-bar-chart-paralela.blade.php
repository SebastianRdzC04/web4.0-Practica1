@php

    $data = $datos ?? [
        ["title" => "Mayores de edad", "data" => [
            ["name" => "Hombres", "data" => 300, "color" => "#3b82f6"],
            ["name" => "Mujeres", "data" => 200, "color" => "#ec4899"],
        ], "total" => 500],
        ["title" => "Menores de edad", "data" => [
            ["name" => "Hombres", "data" => 280, "color" => "#3b82f6"],
            ["name" => "Mujeres", "data" => 320, "color" => "#ec4899"],
        ], "total" => 600]
    ];


    $etiquetas = [];
    $colores = [];

    if (count($data) > 0 && count($data[0]['data']) > 0) {
        foreach ($data[0]['data'] as $item) {
            $etiquetas[] = $item['name'];
            $colores[$item['name']] = $item['color'];
        }
    }

    $doubleBarDataJSON = json_encode($data);
@endphp


<div class="p-4 flex flex-col items-center">
    <canvas id="doubleBarChartParalela" width="400" height="300"></canvas>
    <div class="flex justify-center mt-4">
        @foreach($etiquetas as $etiqueta)
            <div class="flex items-center mr-4">
                <div class="w-4 h-4 mr-2 rounded-sm" style="background-color: {{$colores[$etiqueta]}}"></div>
                <span class="text-gray-700">{{$etiqueta}}</span>
            </div>
        @endforeach
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const canvas = document.getElementById('doubleBarChartParalela');
        const ctx = canvas.getContext('2d');

        const datosPhp = {!! $doubleBarDataJSON !!};

        const anchoCanvas = canvas.width;
        const altoCanvas = canvas.height;
        const margen = 50;
        const areaGrafica = {
            x: margen,
            y: margen,
            ancho: anchoCanvas - margen * 2,
            alto: altoCanvas - margen * 2
        };

        // Encontrar el valor máximo para la escala Y
        let valorMaximo = 0;
        datosPhp.forEach(categoria => {
            categoria.data.forEach(item => {
                if (item.data > valorMaximo) valorMaximo = item.data;
            });
        });

        // Añadir un 10% para mejor visualización
        valorMaximo = Math.ceil(valorMaximo * 1.1);

        const escalaY = areaGrafica.alto / valorMaximo;

        // Calcular el ancho de cada grupo de barras
        const numCategorias = datosPhp.length;
        const anchoCategorias = areaGrafica.ancho / numCategorias;

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
            const valor = Math.round(i * valorMaximo / numLineas);

            ctx.beginPath();
            ctx.moveTo(areaGrafica.x - 5, y);
            ctx.lineTo(areaGrafica.x + areaGrafica.ancho, y);
            ctx.strokeStyle = 'rgba(203, 213, 225, 0.7)';
            ctx.stroke();

            ctx.fillText(valor.toString(), areaGrafica.x - 10, y + 5);
        }

        // Dibujar las barras y etiquetas del eje X
        datosPhp.forEach((categoria, i) => {
            // Posición central del grupo de barras para esta categoría
            const centroCategoriaX = areaGrafica.x + (i * anchoCategorias) + (anchoCategorias / 2);

            // Calcular ancho de cada barra individual dentro del grupo
            const numBarras = categoria.data.length;
            const anchoBarra = anchoCategorias * 0.3; // 30% del espacio disponible para cada barra
            const espacioTotal = anchoCategorias * 0.8;
            const espacioEntreBarras = anchoCategorias * 0.05;
            const inicioGrupo = centroCategoriaX - (espacioTotal / 2);

            // Dibujar etiqueta de total sobre el grupo de barras
            ctx.fillStyle = '#475569';
            ctx.textAlign = 'center';
            ctx.font = 'bold 14px Inter, sans-serif';
            ctx.fillText(`Total: ${categoria.total}`, centroCategoriaX, areaGrafica.y - 15);

            // Dibujar las barras una al lado de la otra
            categoria.data.forEach((item, j) => {
                const alturaBarra = item.data * escalaY;
                const x = inicioGrupo + (j * (anchoBarra + espacioEntreBarras));
                const y = areaGrafica.y + areaGrafica.alto - alturaBarra;

                // Crear gradiente para la barra
                const barGradient = ctx.createLinearGradient(x, y, x, y + alturaBarra);
                const baseColor = item.color;
                const lighterColor = lightenColor(baseColor, 20);

                barGradient.addColorStop(0, baseColor);
                barGradient.addColorStop(1, lighterColor);

                // Dibujar barra redondeada
                roundedRect(ctx, x, y, anchoBarra, alturaBarra, 6, barGradient);

                // Etiquetar valor sobre la barra
                ctx.fillStyle = '#334155';
                ctx.font = 'bold 12px Inter, sans-serif';
                ctx.textAlign = 'center';
                ctx.fillText(item.data.toString(), x + anchoBarra/2, y - 8);
            });

            // Etiqueta de la categoría
            ctx.fillStyle = '#334155';
            ctx.textAlign = 'center';
            ctx.font = '13px Inter, sans-serif';
            ctx.fillText(categoria.title, centroCategoriaX, areaGrafica.y + areaGrafica.alto + 20);
        });

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
