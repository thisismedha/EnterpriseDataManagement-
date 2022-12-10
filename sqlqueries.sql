WITH pr AS (
    SELECT
        id.itemquantity,o.orderid,
        fname,
        lname,
        c.state,
        c.city,
        c.street,
        price,
        deliveryprice,
        count(c.customerid),
        c.customerid
    FROM
             invoice i
        JOIN orders       o ON o.orderid = i.orderid
        JOIN customers    c ON c.customerid = o.customerid
        JOIN item_details id ON id.orderid = o.orderid
        JOIN items        i ON i.itemid = id.itemid
    GROUP BY
       fname,
        lname,
        c.state,
        c.city,
        c.street,
        price,
        deliveryprice,
        c.customerid,
        id.itemquantity,o.orderid
),
que AS(
SELECT
    customerid,
    orderid,
    SUM(CASE
        WHEN itemquantity > 1 THEN
            ( ( price * itemquantity ))
        ELSE
            price 
    END     )  TotalPrice
FROM
    pr
GROUP BY customerid,orderid
)
SELECT     q.customerid,
           q.orderid,
           q.TotalPrice + o.deliveryprice
           
FROM que q
INNER JOIN customers c
    ON c. customerid = q.customerid
INNER JOIN orders o
    ON o.orderid = q.orderid
;
