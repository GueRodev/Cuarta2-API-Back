<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;
use Illuminate\Support\Facades\DB;

class MateriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiar tabla antes de insertar (sin comandos administrativos)
        Materia::truncate();
        
        $materias = [
            ['nombre' => 'Administración General', 'codigo' => 'IN-1001', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Contabilidad Básica', 'codigo' => 'IN-1002', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Matemática Básica', 'codigo' => 'IN-1003', 'creditos' => 4, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Técnicas de Estudio', 'codigo' => 'IN-1004', 'creditos' => 2, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Desarrollo Centroamericano', 'codigo' => 'IN-1005', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Introducción a la Programación', 'codigo' => 'IN-1006', 'creditos' => 4, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Cálculo I', 'codigo' => 'IN-1007', 'creditos' => 4, 'requisitos' => 'IN-1003'],
            ['nombre' => 'Estadística I', 'codigo' => 'IN-1008', 'creditos' => 3, 'requisitos' => 'IN-1003'],
            ['nombre' => 'Inglés I', 'codigo' => 'IN-1009', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Mantenimiento y Arquitectura Micros', 'codigo' => 'IN-1010', 'creditos' => 2, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Cálculo II', 'codigo' => 'IN-1011', 'creditos' => 4, 'requisitos' => 'IN-1007'],
            ['nombre' => 'Inglés II', 'codigo' => 'IN-1012', 'creditos' => 3, 'requisitos' => 'IN-1009'],
            ['nombre' => 'Arquitectura de Computadoras', 'codigo' => 'IN-1013', 'creditos' => 4, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Programación Estructurada en C', 'codigo' => 'IN-1014', 'creditos' => 3, 'requisitos' => 'IN-1006'],
            ['nombre' => 'Física I', 'codigo' => 'IN-1015', 'creditos' => 3, 'requisitos' => 'IN-1007'],
            ['nombre' => 'Bases de Datos', 'codigo' => 'IN-1016', 'creditos' => 3, 'requisitos' => 'IN-1014'],
            ['nombre' => 'Estructura de Datos', 'codigo' => 'IN-1017', 'creditos' => 3, 'requisitos' => 'IN-1014'],
            ['nombre' => 'Teoría General de Sistemas', 'codigo' => 'IN-1018', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Estadística II', 'codigo' => 'IN-1019', 'creditos' => 4, 'requisitos' => 'IN-1008'],
            ['nombre' => 'Programación en IV Generación I', 'codigo' => 'IN-1020', 'creditos' => 4, 'requisitos' => 'IN-1016'],
            ['nombre' => 'Programación en IV Generación II', 'codigo' => 'IN-1021', 'creditos' => 4, 'requisitos' => 'IN-1020'],
            ['nombre' => 'Ética Profesional', 'codigo' => 'IN-1022', 'creditos' => 3, 'requisitos' => 'IN-1004'],
            ['nombre' => 'Organización de Archivos', 'codigo' => 'IN-1023', 'creditos' => 4, 'requisitos' => 'IN-1017'],
            ['nombre' => 'Inglés III', 'codigo' => 'IN-1024', 'creditos' => 3, 'requisitos' => 'IN-1012'],
            ['nombre' => 'Administración Gestión Informática', 'codigo' => 'IN-1025', 'creditos' => 2, 'requisitos' => 'IN-1016'],
            ['nombre' => 'Programacion III Generacion I', 'codigo' => 'IN-1026', 'creditos' => 4, 'requisitos' => 'IN-1021'],
            ['nombre' => 'Análisis de Sistemas', 'codigo' => 'IN-1027', 'creditos' => 3, 'requisitos' => 'IN-1017'],
            ['nombre' => 'Análisis Administrativo', 'codigo' => 'IN-1028', 'creditos' => 3, 'requisitos' => 'IN-1025'],
            ['nombre' => 'Programación Orientada a Objetos', 'codigo' => 'IN-1029', 'creditos' => 4, 'requisitos' => 'IN-1017'],
            ['nombre' => 'Sistemas Operativos Modernos', 'codigo' => 'IN-1030', 'creditos' => 4, 'requisitos' => 'IN-1013'],
            ['nombre' => 'Programacion III Generacion II', 'codigo' => 'IN-1031', 'creditos' => 4, 'requisitos' => 'IN-1021'],
            ['nombre' => 'Telemática y Redes', 'codigo' => 'IN-1032', 'creditos' => 4, 'requisitos' => 'IN-1013'],
            ['nombre' => 'Inglés IV', 'codigo' => 'IN-1033', 'creditos' => 3, 'requisitos' => 'IN-1024'],
            ['nombre' => 'Investigación de Operaciones I', 'codigo' => 'IN-1034', 'creditos' => 3, 'requisitos' => 'IN-1008'],
            ['nombre' => 'Práctica Profesional I', 'codigo' => 'IN-1035', 'creditos' => 3, 'requisitos' => '90% de carrera'],
            ['nombre' => 'Auditoría de Sistemas', 'codigo' => 'IN-1036', 'creditos' => 4, 'requisitos' => 'IN-1028'],
            ['nombre' => 'Configuración de Redes', 'codigo' => 'IN-1037', 'creditos' => 4, 'requisitos' => 'IN-1032'],
            ['nombre' => 'Programación en Visual Basic .NET', 'codigo' => 'IN-1038', 'creditos' => 3, 'requisitos' => 'IN-1029'],
            ['nombre' => 'Práctica Profesional II', 'codigo' => 'IN-1039', 'creditos' => 3, 'requisitos' => 'IN-1035'],
            ['nombre' => 'Fundamentos de Ingeniería Industrial', 'codigo' => 'IN-1041', 'creditos' => 4, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Administración de la Producción I', 'codigo' => 'IN-1042', 'creditos' => 4, 'requisitos' => 'IN-1041'],
            ['nombre' => 'Ecuaciones Diferenciales', 'codigo' => 'IN-1043', 'creditos' => 4, 'requisitos' => 'IN-1011'],
            ['nombre' => 'Economía General', 'codigo' => 'IN-1044', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Int. al Dibujo Técnico con AutoCAD', 'codigo' => 'IN-1045', 'creditos' => 3, 'requisitos' => 'IN-1011'],
            ['nombre' => 'Física II', 'codigo' => 'IN-1046', 'creditos' => 3, 'requisitos' => 'IN-1015'],
            ['nombre' => 'Administración de la Producción II', 'codigo' => 'IN-1047', 'creditos' => 4, 'requisitos' => 'IN-1042'],
            ['nombre' => 'Álgebra Lineal', 'codigo' => 'IN-1048', 'creditos' => 3, 'requisitos' => 'IN-1011'],
            ['nombre' => 'Seguridad y Gestión del Mantenimiento Industrial', 'codigo' => 'IN-1049', 'creditos' => 4, 'requisitos' => 'IN-1041'],
            ['nombre' => 'Administración de la Producción III', 'codigo' => 'IN-1050', 'creditos' => 4, 'requisitos' => 'IN-1047/IN-1048'],
            ['nombre' => 'Contabilidad de Costos', 'codigo' => 'IN-1051', 'creditos' => 3, 'requisitos' => 'IN-1002'],
            ['nombre' => 'Diseño de Métodos', 'codigo' => 'IN-1052', 'creditos' => 3, 'requisitos' => 'IN-1050/IN-1049'],
            ['nombre' => 'Administración de Recursos Humanos', 'codigo' => 'IN-1053', 'creditos' => 3, 'requisitos' => 'IN-1001'],
            ['nombre' => 'Matemática Financiera', 'codigo' => 'IN-1054', 'creditos' => 4, 'requisitos' => 'IN-1043'],
            ['nombre' => 'Investigación de Operaciones II', 'codigo' => 'IN-1055', 'creditos' => 4, 'requisitos' => 'IN-1034'],
            ['nombre' => 'Localización y Distribución de Plantas', 'codigo' => 'IN-1056', 'creditos' => 4, 'requisitos' => 'IN-1045'],
            ['nombre' => 'Estándares en Control de Calidad', 'codigo' => 'IN-1057', 'creditos' => 4, 'requisitos' => 'IN-1047/IN-1050'],
            ['nombre' => 'Sistemas de Información', 'codigo' => 'IN-1058', 'creditos' => 4, 'requisitos' => 'IN-1017/IN-1053'],
            ['nombre' => 'Práctica Profesional I (Metodología de la Investigación)', 'codigo' => 'IN-1059', 'creditos' => 3, 'requisitos' => 'Autorización'],
            ['nombre' => 'Gerencia y Toma de Decisiones', 'codigo' => 'IN-1060', 'creditos' => 3, 'requisitos' => 'IN-1001/IN-1050'],
            ['nombre' => 'Gestión de la Calidad Total', 'codigo' => 'IN-1061', 'creditos' => 4, 'requisitos' => 'IN-1050'],
            ['nombre' => 'Ingeniería Económica', 'codigo' => 'IN-1062', 'creditos' => 4, 'requisitos' => 'IN-1051/IN-1054'],
            ['nombre' => 'Práctica Profesional II', 'codigo' => 'IN-1063', 'creditos' => 3, 'requisitos' => 'IN-1059'],
            ['nombre' => 'Microeconomía I', 'codigo' => 'AD-1001', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Teoría de la Organización', 'codigo' => 'AD-1002', 'creditos' => 3, 'requisitos' => 'IN-1001'],
            ['nombre' => 'Legislación Laboral', 'codigo' => 'AD-1003', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Macroeconomía', 'codigo' => 'AD-1004', 'creditos' => 3, 'requisitos' => 'AD-1001'],
            ['nombre' => 'Legislación Mercantil', 'codigo' => 'AD-1005', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Administración de Recursos Humanos', 'codigo' => 'AD-1006', 'creditos' => 3, 'requisitos' => 'IN-1001'],
            ['nombre' => 'Mercadeo I', 'codigo' => 'AD-1007', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Administración Financiera', 'codigo' => 'AD-1008', 'creditos' => 4, 'requisitos' => 'IN-1002'],
            ['nombre' => 'Contabilidad de Costos', 'codigo' => 'AD-1009', 'creditos' => 3, 'requisitos' => 'IN-1002'],
            ['nombre' => 'Mercadeo II', 'codigo' => 'AD-1010', 'creditos' => 3, 'requisitos' => 'AD-1007'],
            ['nombre' => 'Planificación Financiera', 'codigo' => 'AD-1011', 'creditos' => 4, 'requisitos' => 'IN-1001'],
            ['nombre' => 'Métodos de Análisis Cuantitativos', 'codigo' => 'AD-1012', 'creditos' => 4, 'requisitos' => 'IN-1007'],
            ['nombre' => 'Análisis de Estados Financieros', 'codigo' => 'AD-1013', 'creditos' => 4, 'requisitos' => 'AD-1008'],
            ['nombre' => 'Comercio Internacional', 'codigo' => 'AD-1014', 'creditos' => 3, 'requisitos' => 'AD-1012'],
            ['nombre' => 'Legislación Tributaria y Fiscal', 'codigo' => 'AD-1015', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Investigación de Mercados', 'codigo' => 'AD-1016', 'creditos' => 4, 'requisitos' => 'AD-1010'],
            ['nombre' => 'Auditoría Administrativa', 'codigo' => 'AD-1017', 'creditos' => 4, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Gerencia y Toma de Decisiones', 'codigo' => 'AD-1018', 'creditos' => 4, 'requisitos' => 'AD-1011'],
            ['nombre' => 'Práctica I (Metodología de la Investigación)', 'codigo' => 'AD-1019', 'creditos' => 3, 'requisitos' => '90% de carrera'],
            ['nombre' => 'Administración de Proyectos', 'codigo' => 'AD-1020', 'creditos' => 4, 'requisitos' => 'IN-1006'],
            ['nombre' => 'Mercados Financieros', 'codigo' => 'AD-1021', 'creditos' => 4, 'requisitos' => 'AD-1013'],
            ['nombre' => 'Estrategia Empresarial', 'codigo' => 'AD-1022', 'creditos' => 3, 'requisitos' => 'AD-1002'],
            ['nombre' => 'Práctica II (Trabajo de Graduación)', 'codigo' => 'AD-1023', 'creditos' => 6, 'requisitos' => 'AD-1019'],
            ['nombre' => 'Contabilidad II', 'codigo' => 'CO-2001', 'creditos' => 4, 'requisitos' => 'IN-1002'],
            ['nombre' => 'Control Interno', 'codigo' => 'CO-2002', 'creditos' => 3, 'requisitos' => 'CO-2001'],
            ['nombre' => 'Contabilidad de Sociedades', 'codigo' => 'CO-2003', 'creditos' => 4, 'requisitos' => 'CO-2001'],
            ['nombre' => 'Práctica Contable (Trabajo Campo)', 'codigo' => 'PC-2004', 'creditos' => 5, 'requisitos' => 'CO-2020'],
            ['nombre' => 'Análisis Financiero', 'codigo' => 'CO-2005', 'creditos' => 4, 'requisitos' => 'CO-2003'],
            ['nombre' => 'Auditoría - Introducción', 'codigo' => 'AU-2006', 'creditos' => 3, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Contabilidad Superior', 'codigo' => 'CO-2020', 'creditos' => 4, 'requisitos' => 'CO-2001'],
            ['nombre' => 'Costos por Procesos', 'codigo' => 'CO-2007', 'creditos' => 3, 'requisitos' => 'CO-3060'],
            ['nombre' => 'Moneda y Banca', 'codigo' => 'EC-2008', 'creditos' => 3, 'requisitos' => 'EC-1035'],
            ['nombre' => 'Sistemas Contables', 'codigo' => 'CO-2009', 'creditos' => 3, 'requisitos' => 'CO-3065'],
            ['nombre' => 'Contabilidad de Instituciones Públicas', 'codigo' => 'CO-2010', 'creditos' => 4, 'requisitos' => 'CO-2020'],
            ['nombre' => 'Estudio Completo de Impuestos', 'codigo' => 'CO-2011', 'creditos' => 4, 'requisitos' => 'AD-1015'],
            ['nombre' => 'Inglés Técnico Contable', 'codigo' => 'ID-2012', 'creditos' => 3, 'requisitos' => 'ID-1113'],
            ['nombre' => 'Métodos y Técnicas Presupuestarias', 'codigo' => 'CO-2013', 'creditos' => 4, 'requisitos' => 'CO-3065'],
            ['nombre' => 'Práctica Profesional II (Trabajo de Graduación)', 'codigo' => 'PP-2014', 'creditos' => 6, 'requisitos' => 'MI-1190'],
            ['nombre' => 'Introduccion a la Computacion I', 'codigo' => 'IN-1064', 'creditos' => 4, 'requisitos' => 'Admitido en U'],
            ['nombre' => 'Introduccion a la Computacion II', 'codigo' => 'IN-1065', 'creditos' => 4, 'requisitos' => 'IN-1064'],
            ['nombre' => 'Costos-Introduccion', 'codigo' => 'CO-2015', 'creditos' => 3, 'requisitos' => 'CO-2001'],
            ['nombre' => 'Costos Estandar', 'codigo' => 'CO-2016', 'creditos' => 3, 'requisitos' => 'CO-2007'],
            ['nombre' => 'Auditoria Operativa', 'codigo' => 'CO-2017', 'creditos' => 4, 'requisitos' => 'EC-2008'],
        ];

        // Insertar todas las materias usando chunks para mejor rendimiento
        $chunks = array_chunk($materias, 50);
        
        foreach ($chunks as $chunk) {
            Materia::insert($chunk);
        }

        $this->command->info('✅ Se han insertado ' . count($materias) . ' materias correctamente.');
    }
}