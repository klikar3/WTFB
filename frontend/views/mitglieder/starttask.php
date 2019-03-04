<?php>
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->headers->set('Content-Type', 'text/event-stream');
        header('Content-Type: text/event-stream');
        // recommended to prevent caching of event data.
        header('Cache-Control: no-cache'); 
        set_time_limit(300);
        
        $connection = Yii::$app->db;//get connection
        $dbSchema = $connection->schema;
        //or $connection->getSchema();
        $tables = $dbSchema->tableNames;//returns array of tbl schema's
        ob_start();
        foreach($tables as $tbl)
        {
            echo $tbl, ':<br/>';
        }
        
        $max = Mitglieder::find()->count();
        $i = $percent = 0;
        $errors[] = 'Gefundene Fehler: ';
        foreach (Mitglieder::find()->each(10) as $model) {
            $i += 1;
            if (($i < 50) && !$model->validate()) {
              //Yii::$app->session->setFlash('success', "Mitglied {$model->MitgliederId}, {$model->Name}, {$model->Vorname}");
              $errors[] = 'Mitglied '.$model->MitgliederId.', '.$model->Name.', '.$model->Vorname.' validiert nicht!'.json_encode($model->errors).'<br>';
            }
            $percent = ($i * 100) / $max;
            $this->send_message($i, 'on iteration ' . $i . ' of ' . $max , $percent);
 //           if ($i %10 == 0) $this->renderAjax('progBar', ['percent' => $percent,]);
        }
//         VarDumper::dump($errors);
        $this->send_message('CLOSE', 'Process complete',100);
        return ob_get_clean();
?>
