<?php
class Messages
{
    public function getMessages($sql)
    {
        $prev = 0;
        while ($data = $sql->fetch()) {

            $text .= '<tr><td style="width:15%" valign="top">';
            // Si le dernier message est du même membre, on écrit pas de nouveau son pseudo
            if ($prev != $data['account_id']) {
                $text .= '<a href="#post" onclick="insertLogin(\'' . addslashes($data['account_login']) . '\')">';
                $text .= date('[H:i]', $data['time']);
                $text .= '&nbsp;<span style="color:' . $color . '">' . $data['account_login'] . '</span>';
                $text .= '</a>';
            }
            $text .= '</td>';
            $text .= '<td style="width:85%;padding-left:10px;" valign="top">';

            $message = htmlspecialchars($data['text']);

            $text .= $message . '<br />';
            $text .= '</td></tr>';

            $i++;
            $prev = $data['account_id'];
        }

        return $text;
    }
}
