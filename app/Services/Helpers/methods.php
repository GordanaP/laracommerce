<?php

/**
 * Get the query string.
 *
 * @param  array  $query
 * @return  array
 */
function getQueryString(array $query)
{
    $queryString = array_merge( request()->query(), $query);

    $filteredQuery = array_except($queryString, ['page']);

    return $filteredQuery;
}

/**
 * Remove the query string.
 *
 * @param  string $filter
 * @return  array
 */
function removeQueryString($filter)
{
    $queryString = request()->query();

    $filteredQuery = array_except($queryString, [$filter, 'page']);

    return $filteredQuery;
}

/**
 * Get active class.
 *
 * @param  string $variable1
 * @param  string $variable2
 * @return string
 */
function getActiveClass($variable1, $variable2)
{
    return $variable1 === $variable2 ? 'active' : '';
}

/**
 * An item is in the cart.
 *
 * @param  int $itemId
 * @param  string $cartName
 * @return boolean
 */
function itemIsInCart($itemId, $cartName)
{
    $itemsIds = Cart::instance($cartName)->content()->pluck('id')->toArray();

    return in_array($itemId, $itemsIds);
}