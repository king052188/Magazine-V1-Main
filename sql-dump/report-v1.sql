SELECT issue.*,
                    (
                        SELECT name FROM price_criteria_table WHERE Id = issue.ad_criteria_id AND status = 2
                    ) AS ad_color,
                    (
                        SELECT package_name FROM price_package_table WHERE Id = issue.ad_package_id  AND status = 2
                    ) AS ad_size,
                    (
                        issue.amount * issue.line_item_qty
                    ) AS sub_total_amount,
                    (
                        CASE
                            WHEN issue.line_item_qty > (
                                                        SELECT COUNT(*) AS t_type 
                                                            FROM magzine_discount_table AS d
                                                            INNER JOIN magazine_transaction_table AS t
                                                            ON d.mag_price_id = t.magazine_id
                                                        WHERE t.Id = issue.magazine_trans_id AND d.percent != 0
                                                        ) THEN
                                
                                (
                                    SELECT d.percent AS Discount 
                                        FROM magzine_discount_table AS d
                                        INNER JOIN magazine_transaction_table AS t
                                        ON d.mag_price_id = t.magazine_id
                                    WHERE t.Id = issue.magazine_trans_id AND d.percent != 0 
                                    AND type = (
                                        SELECT (COUNT(*) + 1) AS t_type 
                                            FROM magzine_discount_table AS d
                                            INNER JOIN magazine_transaction_table AS t
                                            ON d.mag_price_id = t.magazine_id
                                        WHERE t.Id = issue.magazine_trans_id AND d.percent != 0
                                    )
                                ) * 100
                                
                            WHEN issue.line_item_qty = 1 THEN
                                0
                            ELSE
                                (
                                    SELECT d.percent AS Discount 
                                        FROM magzine_discount_table AS d
                                        INNER JOIN magazine_transaction_table AS t
                                        ON d.mag_price_id = t.magazine_id
                                    WHERE t.Id = issue.magazine_trans_id AND d.percent != 0 AND type = issue.line_item_qty
                                ) * 100
                        END
                    ) AS total_discount_by_percent,
                    (
                        CASE
                            WHEN issue.line_item_qty > (
                                                        SELECT COUNT(*) AS t_type 
                                                            FROM magzine_discount_table AS d
                                                            INNER JOIN magazine_transaction_table AS t
                                                            ON d.mag_price_id = t.magazine_id
                                                        WHERE t.Id = issue.magazine_trans_id AND d.percent != 0
                                                        ) THEN
                                
                                (issue.amount * issue.line_item_qty) - 
                                ((issue.amount * issue.line_item_qty) * (
                                    SELECT d.percent AS Discount 
                                        FROM magzine_discount_table AS d
                                        INNER JOIN magazine_transaction_table AS t
                                        ON d.mag_price_id = t.magazine_id
                                    WHERE t.Id = issue.magazine_trans_id AND d.percent != 0 
                                    AND type = (
                                        SELECT (COUNT(*) + 1) AS t_type 
                                            FROM magzine_discount_table AS d
                                            INNER JOIN magazine_transaction_table AS t
                                            ON d.mag_price_id = t.magazine_id
                                        WHERE t.Id = issue.magazine_trans_id AND d.percent != 0
                                    )
                                ))
                                
                            WHEN issue.line_item_qty = 1 THEN
                                (issue.amount * issue.line_item_qty) - ((issue.amount * issue.line_item_qty) * 0)
                            ELSE
                                (issue.amount * issue.line_item_qty) - 
                                ((issue.amount * issue.line_item_qty) * (
                                    SELECT d.percent AS Discount 
                                        FROM magzine_discount_table AS d
                                        INNER JOIN magazine_transaction_table AS t
                                        ON d.mag_price_id = t.magazine_id
                                    WHERE t.Id = issue.magazine_trans_id AND d.percent != 0 AND type = issue.line_item_qty
                                ))
                        END
                    ) AS total_amount_with_discount
                    
                    FROM magazine_issue_transaction_table AS issue
                    
                    WHERE magazine_trans_id = {$mag_id} AND status = 2;