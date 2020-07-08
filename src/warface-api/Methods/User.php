<?php

namespace Warface\Methods;

use Warface\RequestController;

class User
{
    private RequestController $class;

    /**
     * User constructor.
     * @param RequestController $controller
     */
    public function __construct(RequestController $controller)
    {
        $this->class = $controller;
    }

    /**
     * @param string|int $name
     * @param int $server
     * @param int $format
     * @return array
     */
    public function stat(?string $name, int $server, int $format = 0): array
    {
        $request = $this->class->request('user/stat', [
            'name' => $name,
            'server' => $server
        ]);

        switch ($format)
        {
            case 1:
                unset($request['full_response']);
                break;

            case 2:

                /**
                 * Source: https://qna.habr.com/answer?answer_id=1298038
                 * @author @Catrinblaidd
                 */

                $pre_make = function ($keys, $value) use (&$pre_make)
                {
                    $result = [];
                    switch (sizeof($keys)) {
                        case 1:
                            $key = $keys[0];
                            $result[$key] = $value;
                            break;

                        default:
                            $key = array_shift($keys);
                            $result[$key] = $pre_make($keys, $value);
                            break;
                    }

                    return $result;
                };

                $fullResponse = explode("\n", $request['full_response']);
                $result = [];

                foreach ($fullResponse as $string)
                {
                    $string = preg_split('/[\s]*=[\s]*/u', $string, -1, PREG_SPLIT_NO_EMPTY);

                    if ($string)
                    {
                        preg_match_all('/[\s]*\[([^\[\]]+)\]([^\[\]]+)/', $string[0], $matches);
                        for ($i = 1; $i < sizeof($matches); $i += 2)
                        {
                            $keys = [];
                            foreach ($matches[$i] as $num => $key) {
                                $keys[] = $key;
                                $keys[] = trim($matches[$i + 1][$num]);
                            }

                            $result = array_merge_recursive($result, $pre_make($keys, $string[1]));
                        }
                    }
                }

                $request['full_response'] = $result;
                break;
        }

        return $request;
    }

    /**
     * @param string|int $name
     * @param int $server
     * @return array
     */
    public function achievements(?string $name, int $server): array
    {
        return $this->class->request('user/achievements', [
            'name' => $name,
            'server' => $server
        ]);
    }
}