<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
        require '../web_connection.php';
        if(isset($_POST['year']) && isset($_POST['type_index']) && isset($_POST['index_consult'])){
            $year = $_POST['year'];
            $type_report = $_POST['type_index'];
            $id_consulta = $_POST['index_consult'];
            switch($type_report){
                case 0:
                    get_all_indicators($year);
                    break;
                case 1:
                    get_indicators_by_direction($year, $id_consulta);
                    break;
                case 2:
                    get_indicators_by_subdirection($year, $id_consulta);
                    break;
                case 3:
                    get_indicators_by_region($year, $id_consulta);
                    break;
                case 4:
                    get_indicators_by_office($year, $id_consulta);
                    break;
                default:
                    get_all_indicators($year);
                    break;
            }
        }
    }
    
    function get_all_indicators($year){
		global $connect;

        $query_applicants = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , (SUM(ai.applicants_dm) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'DM'
                                , (SUM(ai.applicants_papel) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'Papel' 
                            FROM tb_indicators_applicants ai 
                            INNER JOIN sys_tb_indicators_months mi 
                                ON mi.number_month = ai.month 
                            where ai.year = '$year' 
                            GROUP BY mi.letter_month order by mi.number_month ";
        $result_applicants = mysqli_query($connect, $query_applicants);
        
        $query_request = "select 'All' As 'Grupo'
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        where ri.year = '$year'
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_request = mysqli_query($connect, $query_request);

        $query_reworks = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , DATE_FORMAT(CONCAT(ri.year, '-', ri.month,'-01'), '%Y-%m-%d') as 'year'
                                , (SUM(ri.send_documents) / SUM(ri.send_necesary)) As 'value' 
                        FROM tb_indicators_reworks ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        where ri.year = '$year' 
                        GROUP BY mi.letter_month order by mi.number_month  ";
        $result_reworks = mysqli_query($connect, $query_reworks);

        $query_prospects = "SELECT 'All' As 'Grupo'
                    , mi.letter_month as 'Month'
                    , (SUM(ai.applicants_prospectos)) As 'Prospectos'
                    , (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))  As 'Clientes' 
                FROM tb_indicators_applicants ai 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ai.month 
                where ai.year = 2018 
                GROUP BY mi.letter_month order by mi.number_month ";
        $result_prospects = mysqli_query($connect, $query_prospects);
        
        $query_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        where ri.year = '$year'
                        GROUP BY mi.letter_month order by mi.number_month; ";
        $result_csc_reworks = mysqli_query($connect, $query_csc_reworks);

        $query_now_solicitantes = "SELECT 
                                        'All' AS 'Grupo' 
                                        , ai.year
                                        , mi.letter_month AS 'Month' 
                                        , (SUM(ai.applicants_dm) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 AS 'DM' 
                                        , (SUM(ai.applicants_papel) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 AS 'Papel' 
                                    FROM tb_indicators_applicants ai 
                                        INNER JOIN sys_tb_indicators_months mi 
                                    ON mi.number_month = ai.month
                                    WHERE ai.year = YEAR(CURDATE())
                                            AND month = (SELECT MAX(month) FROM tb_indicators_applicants WHERE year = YEAR(CURDATE())) 
                                    GROUP BY ai.year, mi.letter_month ORDER BY mi.number_month ";
        $result_now_solicitantes = mysqli_query($connect, $query_now_solicitantes);

        $query_now_solicitudes = "SELECT 'All' As 'Grupo'
                            , ri.year
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        WHERE ri.year = YEAR(CURDATE())
                            AND month = (SELECT MAX(month) FROM tb_indicators_requests WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month ";
        $result_now_solicitudes = mysqli_query($connect, $query_now_solicitudes);

        $query_now_reworks = "SELECT 'All' As 'Grupo'
                        , mi.letter_month as 'Month'
                        , ri.year as 'year'
                        , ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1) * 100.0 As 'retrabajos' 
                        , (1 - ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1)) * 100.0 AS 'aceptados'
                FROM tb_indicators_reworks ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month 
                where ri.year = YEAR(CURDATE()) AND ri.month = (select max(month) FROM tb_indicators_reworks WHERE year = YEAR(CURDATE()) )
                GROUP BY mi.letter_month order by mi.number_month; ";
        $result_now_reworks = mysqli_query($connect, $query_now_reworks);

        $query_now_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , ri.year
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        where ri.year = YEAR(CURDATE())
                            AND month = (SELECT MAX(month) FROM tb_indicators_css_reworks WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month;";
        $result_now_csc_reworks = mysqli_query($connect, $query_now_csc_reworks);
        
        request_json_result($result_applicants, $result_reworks, $result_request, $result_csc_reworks, $result_now_solicitantes, $result_now_solicitudes, $result_now_reworks, $result_now_csc_reworks, $result_prospects);
    }
    
    function get_indicators_by_direction($year, $id_consulta){
        global $connect;

        $query_applicants = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , (SUM(ai.applicants_dm) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'DM'
                                , (SUM(ai.applicants_papel) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'Papel' 
                            FROM tb_indicators_applicants ai 
                            INNER JOIN sys_tb_indicators_months mi
                                ON mi.number_month = ai.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ai.id_os
                            INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                            INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                            INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                                where ai.year = '$year' and dir.id = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month";
        $result_applicants = mysqli_query($connect, $query_applicants);
        
        $query_reworks = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , DATE_FORMAT(CONCAT(ri.year, '-', ri.month,'-01')
                                , '%Y-%m-%d') as 'year'
                                , (SUM(ri.send_documents) / SUM(ri.send_necesary)) As 'value' 
                            FROM tb_indicators_reworks ri 
                            INNER JOIN sys_tb_indicators_months mi 
                                ON mi.number_month = ri.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                            INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                            INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                            INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                                where ri.year = '$year' and dir.id = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month  ";
        $result_reworks = mysqli_query($connect, $query_reworks);
        
        $query_request = "select 'All' As 'Grupo'
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                            where ri.year = '$year' and dir.id = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_request = mysqli_query($connect, $query_request);
        
        $query_prospects = "SELECT 'All' As 'Grupo'
                    , mi.letter_month as 'Month'
                    , (SUM(ri.applicants_prospectos)) As 'Prospectos'
                    , (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))  As 'Clientes' 
                FROM tb_indicators_applicants ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month 
                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                    where ri.year = '$year' and dir.id = '$id_consulta' 
                GROUP BY mi.letter_month order by mi.number_month ";
        $result_prospects = mysqli_query($connect, $query_prospects);

        $query_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM tb_indicators_css_reworks ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                            where ri.year = '$year' and dir.id = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_csc_reworks = mysqli_query($connect, $query_csc_reworks);

        $query_now_solicitantes = "SELECT 
                                    'All' AS 'Grupo' 
                                    , ri.year
                                    , mi.letter_month AS 'Month' 
                                    , (SUM(ri.applicants_dm) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'DM' 
                                    , (SUM(ri.applicants_papel) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'Papel' 
                                FROM tb_indicators_applicants ri 
                                INNER JOIN sys_tb_indicators_months mi 
                                    ON mi.number_month = ri.month
                                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                                INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                                INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                                INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                                WHERE ri.year = YEAR(CURDATE()) and dir.id = '$id_consulta' 
                                        AND month = (SELECT MAX(month) FROM tb_indicators_applicants WHERE year = YEAR(CURDATE())) 
                                GROUP BY ri.year, mi.letter_month ORDER BY mi.number_month";
        $result_now_solicitantes = mysqli_query($connect, $query_now_solicitantes);

        $query_now_solicitudes = "SELECT 'All' As 'Grupo'
                            , ri.year
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                        WHERE ri.year = YEAR(CURDATE()) and dir.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_requests WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month ";
        $result_now_solicitudes = mysqli_query($connect, $query_now_solicitudes);

        $query_now_reworks = "SELECT 'All' As 'Grupo'
                        , mi.letter_month as 'Month'
                        , ri.year as 'year'
                        , ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1) * 100.0 As 'retrabajos' 
                        , (1 - ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1)) * 100.0 AS 'aceptados'
                FROM tb_indicators_reworks ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month
                    INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id 
                where ri.year = YEAR(CURDATE()) and dir.id = '$id_consulta'
                    AND ri.month = (select max(month) FROM tb_indicators_reworks WHERE year = YEAR(CURDATE()) )
                GROUP BY mi.letter_month order by mi.number_month; ";
        $result_now_reworks = mysqli_query($connect, $query_now_reworks);

        $query_now_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , ri.year
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        INNER JOIN sys_structure_directions dir on dir.id = sub.direction_id
                        where ri.year = YEAR(CURDATE()) and dir.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_css_reworks WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month;";
        $result_now_csc_reworks = mysqli_query($connect, $query_now_csc_reworks);

        request_json_result($result_applicants, $result_reworks, $result_request, $result_csc_reworks, 
                    $result_now_solicitantes, $result_now_solicitudes, $result_now_reworks, $result_now_csc_reworks, $result_prospects);
    }

    function get_indicators_by_subdirection($year, $id_consulta){
        global $connect;

        $query_applicants = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , (SUM(ai.applicants_dm) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'DM'
                                , (SUM(ai.applicants_papel) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'Papel' 
                            FROM tb_indicators_applicants ai 
                            INNER JOIN sys_tb_indicators_months mi
                                ON mi.number_month = ai.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ai.id_os
                            INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                            INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                                where ai.year = '$year' and sub.id = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month";
        $result_applicants = mysqli_query($connect, $query_applicants);
        
        $query_reworks = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , DATE_FORMAT(CONCAT(ri.year, '-', ri.month,'-01')
                                , '%Y-%m-%d') as 'year'
                                , (SUM(ri.send_documents) / SUM(ri.send_necesary)) As 'value' 
                            FROM tb_indicators_reworks ri 
                            INNER JOIN sys_tb_indicators_months mi 
                                ON mi.number_month = ri.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                            INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                            INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                                where ri.year = '$year' and sub.id = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month  ";
        $result_reworks = mysqli_query($connect, $query_reworks);
        
        $query_request = "select 'All' As 'Grupo'
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                            where ri.year = '$year' and sub.id = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_request = mysqli_query($connect, $query_request);

        $query_prospects = "SELECT 'All' As 'Grupo'
                    , mi.letter_month as 'Month'
                    , (SUM(ri.applicants_prospectos)) As 'Prospectos'
                    , (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))  As 'Clientes' 
                FROM tb_indicators_applicants ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month 
                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                    where ri.year = '$year' and sub.id = '$id_consulta' 
                GROUP BY mi.letter_month order by mi.number_month ";
        $result_prospects = mysqli_query($connect, $query_prospects);
        
        $query_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM tb_indicators_css_reworks ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                            where ri.year = '$year' and sub.id = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_csc_reworks = mysqli_query($connect, $query_csc_reworks);

        $query_now_solicitantes = "SELECT 
                                    'All' AS 'Grupo' 
                                    , ri.year
                                    , mi.letter_month AS 'Month' 
                                    , (SUM(ri.applicants_dm) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'DM' 
                                    , (SUM(ri.applicants_papel) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'Papel' 
                                FROM tb_indicators_applicants ri 
                                INNER JOIN sys_tb_indicators_months mi 
                                    ON mi.number_month = ri.month
                                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                                INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                                INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                                WHERE ri.year = YEAR(CURDATE()) and sub.id = '$id_consulta' 
                                        AND month = (SELECT MAX(month) FROM tb_indicators_applicants WHERE year = YEAR(CURDATE())) 
                                GROUP BY ri.year, mi.letter_month ORDER BY mi.number_month";
        $result_now_solicitantes = mysqli_query($connect, $query_now_solicitantes);

        $query_now_solicitudes = "SELECT 'All' As 'Grupo'
                            , ri.year
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        WHERE ri.year = YEAR(CURDATE()) and sub.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_requests WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month ";
        $result_now_solicitudes = mysqli_query($connect, $query_now_solicitudes);

        $query_now_reworks = "SELECT 'All' As 'Grupo'
                        , mi.letter_month as 'Month'
                        , ri.year as 'year'
                        , ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1) * 100.0 As 'retrabajos' 
                        , (1 - ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1)) * 100.0 AS 'aceptados'
                FROM tb_indicators_reworks ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month
                    INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                where ri.year = YEAR(CURDATE()) and sub.id = '$id_consulta'
                    AND ri.month = (select max(month) FROM tb_indicators_reworks WHERE year = YEAR(CURDATE()) )
                GROUP BY mi.letter_month order by mi.number_month; ";
        $result_now_reworks = mysqli_query($connect, $query_now_reworks);

        $query_now_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , ri.year
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        INNER JOIN sys_structure_subdirections sub on sub.id = reg.subdirection_id
                        where ri.year = YEAR(CURDATE()) and sub.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_css_reworks WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month;";
        $result_now_csc_reworks = mysqli_query($connect, $query_now_csc_reworks);

        request_json_result($result_applicants, $result_reworks, $result_request, $result_csc_reworks,  $result_now_solicitantes
            , $result_now_solicitudes, $result_now_reworks, $result_now_csc_reworks, $result_prospects);
    }

    function get_indicators_by_region($year, $id_consulta){
        global $connect;

        $query_applicants = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , (SUM(ai.applicants_dm) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'DM'
                                , (SUM(ai.applicants_papel) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'Papel' 
                            FROM tb_indicators_applicants ai 
                            INNER JOIN sys_tb_indicators_months mi
                                ON mi.number_month = ai.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ai.id_os
                            INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                                where ai.year = '$year' and reg.id = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month";
        $result_applicants = mysqli_query($connect, $query_applicants);
        
        $query_reworks = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , DATE_FORMAT(CONCAT(ri.year, '-', ri.month,'-01')
                                , '%Y-%m-%d') as 'year'
                                , (SUM(ri.send_documents) / SUM(ri.send_necesary)) As 'value' 
                            FROM tb_indicators_reworks ri 
                            INNER JOIN sys_tb_indicators_months mi 
                                ON mi.number_month = ri.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                            INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                                where ri.year = '$year' and reg.id = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month  ";
        $result_reworks = mysqli_query($connect, $query_reworks);
        
        $query_request = "select 'All' As 'Grupo'
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                            where ri.year = '$year' and reg.id = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_request = mysqli_query($connect, $query_request);

        $query_prospects = "SELECT 'All' As 'Grupo'
                    , mi.letter_month as 'Month'
                    , (SUM(ri.applicants_prospectos)) As 'Prospectos'
                    , (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))  As 'Clientes' 
                FROM tb_indicators_applicants ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month 
                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                    where ri.year = '$year' and reg.id = '$id_consulta' 
                GROUP BY mi.letter_month order by mi.number_month ";
        $result_prospects = mysqli_query($connect, $query_prospects);
        
        $query_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                            where ri.year = '$year' and reg.id = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_csc_reworks = mysqli_query($connect, $query_csc_reworks);

        $query_now_solicitantes = "SELECT 
                                    'All' AS 'Grupo' 
                                    , ri.year
                                    , mi.letter_month AS 'Month' 
                                    , (SUM(ri.applicants_dm) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'DM' 
                                    , (SUM(ri.applicants_papel) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'Papel' 
                                FROM tb_indicators_applicants ri 
                                INNER JOIN sys_tb_indicators_months mi 
                                    ON mi.number_month = ri.month
                                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                                INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                                WHERE ri.year = YEAR(CURDATE()) and reg.id = '$id_consulta' 
                                        AND month = (SELECT MAX(month) FROM tb_indicators_applicants WHERE year = YEAR(CURDATE())) 
                                GROUP BY ri.year, mi.letter_month ORDER BY mi.number_month";
        $result_now_solicitantes = mysqli_query($connect, $query_now_solicitantes);

        $query_now_solicitudes = "SELECT 'All' As 'Grupo'
                            , ri.year
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        WHERE ri.year = YEAR(CURDATE()) and reg.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_requests WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month ";
        $result_now_solicitudes = mysqli_query($connect, $query_now_solicitudes);

        $query_now_reworks = "SELECT 'All' As 'Grupo'
                        , mi.letter_month as 'Month'
                        , ri.year as 'year'
                        , ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1) * 100.0 As 'retrabajos' 
                        , (1 - ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1)) * 100.0 AS 'aceptados'
                FROM tb_indicators_reworks ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month
                    INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                where ri.year = YEAR(CURDATE()) and reg.id = '$id_consulta'
                    AND ri.month = (select max(month) FROM tb_indicators_reworks WHERE year = YEAR(CURDATE()) )
                GROUP BY mi.letter_month order by mi.number_month; ";
        $result_now_reworks = mysqli_query($connect, $query_now_reworks);

        $query_now_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , ri.year
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        INNER JOIN sys_structure_regions reg on reg.id = ofi.region_id
                        where ri.year = YEAR(CURDATE()) and reg.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_css_reworks WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month;";
        $result_now_csc_reworks = mysqli_query($connect, $query_now_csc_reworks);

        request_json_result($result_applicants, $result_reworks, $result_request, $result_csc_reworks
                    ,  $result_now_solicitantes, $result_now_solicitudes, $result_now_reworks, $result_now_csc_reworks, $result_prospects);
    }

    function get_indicators_by_office($year, $id_consulta){
        global $connect;

        $query_applicants = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , (SUM(ai.applicants_dm) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'DM'
                                , (SUM(ai.applicants_papel) / (SUM(ai.applicants_dm) + SUM(ai.applicants_papel))) * 100.0 As 'Papel' 
                            FROM tb_indicators_applicants ai 
                            INNER JOIN sys_tb_indicators_months mi
                                ON mi.number_month = ai.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ai.id_os
                                where ai.year = '$year' and ai.id_os = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month";
        $result_applicants = mysqli_query($connect, $query_applicants);
        
        $query_reworks = "select 'All' As 'Grupo'
                                , mi.letter_month as 'Month'
                                , DATE_FORMAT(CONCAT(ri.year, '-', ri.month,'-01')
                                , '%Y-%m-%d') as 'year'
                                , (SUM(ri.send_documents) / SUM(ri.send_necesary)) As 'value' 
                            FROM tb_indicators_reworks ri 
                            INNER JOIN sys_tb_indicators_months mi 
                                ON mi.number_month = ri.month 
                            INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                                where ri.year = '$year' and ri.id_os = '$id_consulta' 
                            GROUP BY mi.letter_month order by mi.number_month  ";
        $result_reworks = mysqli_query($connect, $query_reworks);
        
        $query_request = "select 'All' As 'Grupo'
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                            where ri.year = '$year' and ri.id_os = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_request = mysqli_query($connect, $query_request);

        $query_prospects = "SELECT 'All' As 'Grupo'
                    , mi.letter_month as 'Month'
                    , (SUM(ri.applicants_prospectos)) As 'Prospectos'
                    , (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))  As 'Clientes' 
                FROM tb_indicators_applicants ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month 
                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                    where ri.year = '$year' and ofi.id = '$id_consulta' 
                GROUP BY mi.letter_month order by mi.number_month ";
        $result_prospects = mysqli_query($connect, $query_prospects);
        
        $query_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                            where ri.year = '$year' and ri.id_os = '$id_consulta' 
                        GROUP BY mi.letter_month order by mi.number_month ";
        $result_csc_reworks = mysqli_query($connect, $query_csc_reworks);

        $query_now_solicitantes = "SELECT 
                                    'All' AS 'Grupo' 
                                    , ri.year
                                    , mi.letter_month AS 'Month' 
                                    , (SUM(ri.applicants_dm) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'DM' 
                                    , (SUM(ri.applicants_papel) / (SUM(ri.applicants_dm) + SUM(ri.applicants_papel))) * 100.0 AS 'Papel' 
                                FROM tb_indicators_applicants ri 
                                INNER JOIN sys_tb_indicators_months mi 
                                    ON mi.number_month = ri.month
                                INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                                WHERE ri.year = YEAR(CURDATE()) and ofi.id = '$id_consulta' 
                                        AND month = (SELECT MAX(month) FROM tb_indicators_applicants WHERE year = YEAR(CURDATE())) 
                                GROUP BY ri.year, mi.letter_month ORDER BY mi.number_month";
        $result_now_solicitantes = mysqli_query($connect, $query_now_solicitantes);

        $query_now_solicitudes = "SELECT 'All' As 'Grupo'
                            , ri.year
                            , mi.letter_month as 'Month'
                            , (SUM(ri.requests_dm) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM'
                            , (SUM(ri.requests_dm_os) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'DM_OS'
                            , (SUM(ri.requests_papel) / (SUM(ri.requests_dm) + SUM(ri.requests_dm_os) + SUM(ri.requests_papel))) * 100.0 As 'Papel' 
                        FROM tb_indicators_requests ri 
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        WHERE ri.year = YEAR(CURDATE()) and ofi.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_requests WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month ";
        $result_now_solicitudes = mysqli_query($connect, $query_now_solicitudes);

        $query_now_reworks = "SELECT 'All' As 'Grupo'
                        , mi.letter_month as 'Month'
                        , ri.year as 'year'
                        , ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1) * 100.0 As 'retrabajos' 
                        , (1 - ((SUM(ri.send_documents) / SUM(ri.send_necesary)) - 1)) * 100.0 AS 'aceptados'
                FROM tb_indicators_reworks ri 
                INNER JOIN sys_tb_indicators_months mi 
                    ON mi.number_month = ri.month
                    INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                where ri.year = YEAR(CURDATE()) and ofi.id = '$id_consulta'
                    AND ri.month = (select max(month) FROM tb_indicators_reworks WHERE year = YEAR(CURDATE()) )
                GROUP BY mi.letter_month order by mi.number_month; ";
        $result_now_reworks = mysqli_query($connect, $query_now_reworks);

        $query_now_csc_reworks = "SELECT 'All' AS 'Grupo'
                                , ri.year
                                , mi.letter_month as 'Month' 
                                , (SUM(ri.approved) / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00 AS 'Aprobados'
                                , (SUM(ri.incident)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  AS 'Incidencia' 
                                , (SUM(ri.recovery)  / (SUM(ri.approved) + SUM(ri.incident) + SUM(ri.recovery))) * 100.00  As 'Recuperaciones' 
                        FROM `tb_indicators_css_reworks` ri
                        INNER JOIN sys_tb_indicators_months mi 
                            ON mi.number_month = ri.month 
                        INNER JOIN sys_structure_offices ofi on ofi.id = ri.id_os
                        where ri.year = YEAR(CURDATE()) and ofi.id = '$id_consulta'
                            AND month = (SELECT MAX(month) FROM tb_indicators_css_reworks WHERE year = YEAR(CURDATE()))
                        GROUP BY ri.year, mi.letter_month order by mi.number_month;";
        $result_now_csc_reworks = mysqli_query($connect, $query_now_csc_reworks);

        request_json_result($result_applicants, $result_reworks, $result_request, $result_csc_reworks
                , $result_now_solicitantes, $result_now_solicitudes, $result_now_reworks, $result_now_csc_reworks, $result_prospects);
    }

    function request_json_result($result_applicants, $result_reworks, $result_request, $result_csc_reworks
                                            , $result_now_solicitantes, $result_now_solicitudes, $result_now_reworks
                                            , $result_now_csc_reworks, $result_prospects){
        global $connect;

        $json_request = array();
        $json_data_result = array();
        $json_data_result_applicants = array();
        $json_data_result_reworks = array();
        $json_data_result_request = array();
        $json_data_result_css_reworks = array();
        $json_data_now_solicitantes = array();
        $json_data_now_solicitudes = array();
        $json_data_now_reworks= array();
        $json_data_now_csc_reworks = array();
        $json_data_result_prospects = array();

		if($result_applicants && $result_reworks && $result_request){
            $json_data = array();
            
			while($row = mysqli_fetch_assoc($result_applicants)){
				$json_data_result_applicants[] = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_reworks)){
				$json_data_result_reworks[] = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_request)){
				$json_data_result_request[] = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_csc_reworks)){
				$json_data_result_css_reworks[] = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_now_solicitantes)){
                $json_data_now_solicitantes[]  = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_now_solicitudes)){
                $json_data_now_solicitudes[]  = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_now_reworks)){
                $json_data_now_reworks[]  = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_now_csc_reworks)){
                $json_data_now_csc_reworks[]  = array_map('utf8_encode', $row);
            }

            while($row = mysqli_fetch_assoc($result_prospects)){
                $json_data_result_prospects[]  = array_map('utf8_encode', $row);
            }

            $json_data_result['applicants'] = $json_data_result_applicants;
            $json_data_result['reworks'] = $json_data_result_reworks;
            $json_data_result['requests'] = $json_data_result_request;
            $json_data_result['prospects'] = $json_data_result_prospects;
            $json_data_result['csc_reworks'] = $json_data_result_css_reworks;
            $json_data_result['now_solicitantes'] = $json_data_now_solicitantes;
            $json_data_result['now_solicitudes'] = $json_data_now_solicitudes;
            $json_data_result['now_reworks'] = $json_data_now_reworks;
            $json_data_result['now_csc_reworks'] = $json_data_now_csc_reworks;

			$json_request['result'] = true;
			$json_request['message'] = 'Success';
			$json_request['data'] = $json_data_result;
		}else{
			$json_request['result'] = false;
			$json_request['message'] = 'Error';
			$json_request['data'] = array();
		}

		header('Content-type: application/json; charset=utf.8');
		//$json['result'][] = $json_result;
		echo json_encode($json_request, JSON_PRETTY_PRINT);

		//mysqli_free_result($result);

		mysqli_close($connect);
    }

?>