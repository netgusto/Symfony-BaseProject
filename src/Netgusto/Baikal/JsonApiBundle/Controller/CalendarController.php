<?php

namespace Netgusto\Baikal\JsonApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Netgusto\Baikal\DavServicesBundle\Entity\User;
use Netgusto\Baikal\DavServicesBundle\Entity\Calendar;

class CalendarController extends Controller
{
    public function fetchrangeAction(Request $request, Calendar $calendar) {
        
        $response = new JsonResponse();

        # start
        $start = $request->query->get('start');

        # end
        $end = $request->query->get('end');

        if(is_null($start) || is_null($end)) {
            $response->setStatusCode(404);
            $response->setData('Error: both start and end are required');
            return $response;
        }

        # TODO: handle timezones properly (with regards for the calendar timezone)
        $timezone = new \DateTimeZone('Europe/Paris');
        $dtStart = new \DateTime(); $dtStart->setTimezone($timezone); $dtStart->setTimestamp($start);
        $dtEnd = new \DateTime(); $dtEnd->setTimezone($timezone); $dtEnd->setTimestamp($end);

        $events = $this->getDoctrine()->getManager()
            ->getRepository('\Netgusto\Baikal\DavServicesBundle\Entity\CalendarEvent')
            ->findByCalendarAndTimeRange($calendar, $dtStart, $dtEnd);

        $aRes = array();
        foreach($events as $event) {
            if(!$event->isCalendarEvent()) {
                continue;
            }

            $vobject = $event->getVObject();
            $vobject->expand($dtStart, $dtEnd);

            foreach($vobject->VEVENT as $vevent) {

                $veventstart = $vevent->DTSTART->getDateTime();
                $veventend = $vevent->DTEND->getDateTime();

                # We have to determine if the event has to be displayed as 'allDay' or not
                $diff = $veventend->diff($veventstart, TRUE);   # TRUE = absolute value (always positive)
                if(
                    (($diff->h % 24) === 0) &&
                    ($diff->m  === 0) &&
                    ($diff->s  === 0)
                ) {
                    $allDay = TRUE;
                    $veventend = $event->getEnd()->sub(new \DateInterval('P1D')); # removing 1 day to accomodate fullcalendar display rules
                } else {
                    $allDay = FALSE;
                }

                $veventstart->setTimezone($timezone);
                $veventend->setTimezone($timezone);

                $eventcolor = substr($event->getCalendar()->getCalendarcolor(), 1, 6); # Stripping the '#' and the alpha part (last two hex-chars)

                $aRes[] = array(
                    'id' => $event->getUri(),
                    'title' => (string)$event->getSummary(),
                    'allDay' => $allDay,
                    'start' => $veventstart->format(\DateTime::ISO8601),
                    'end' => $veventend->format(\DateTime::ISO8601),
                    'color' => '#' . $eventcolor,
                    'textColor' => $this->getContrastYIQ($eventcolor),
                    # 'url'
                    # 'className'
                    # 'editable'
                    # 'startEditable'
                    # 'durationEditable'
                    //'color' => 'red',
                    # 'backgroundColor'
                    # 'borderColor'
                    
                );
            }
        }

        $response->setData($aRes);
        $response->setCharset('utf-8');
        
        return $response;
    }

    protected function getContrastYIQ($hexcolor) {
        $r = hexdec(substr($hexcolor,0,2));
        $g = hexdec(substr($hexcolor,2,2));
        $b = hexdec(substr($hexcolor,4,2));
        $yiq = (($r*299)+($g*587)+($b*114))/1000;
        return ($yiq >= 128) ? 'black' : 'white';
    }
}
